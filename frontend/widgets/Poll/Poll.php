<?php


namespace frontend\widgets\Poll;

use post\entities\Poll\Polls;
use post\entities\Poll\PollsResult;
use post\forms\poll\PollsResultSearch;
use Yii;
use yii\base\Widget;
use post\entities\User\User;

class Poll extends Widget
{

    /**
     * Model for poll results
     * @var type
     */
    private $model;

    /**
     * Define poll_id which poll will be questioned
     * @var integer
     */
    public $idPoll;

    /**
     * Define how to show results: chart or table
     * @var type string
     */
    public $resultView;

    /**
     * Contain poll for which voting will be organized
     * @var type Polls
     */
    private $pollsProvider;

    public function init() {
        parent::init();
    }

    /**
     * Creates a new PollsResult model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    private function createResult() {

        $modelsaved = false;
        $answers = $this->model->answer_id;
        foreach ( $answers as $answer_id ) {
            $modelMulti = new PollsResult();
            $modelMulti->poll_id = $this->model->poll_id;
            $modelMulti->num = $this->model->num;
            $modelMulti->create_at = $this->model->create_at;
            $modelMulti->update_at = date('Y-m-d H:i:s');
            $modelMulti->ip = $this->model->ip;
            $modelMulti->host = $this->model->host;
            $modelMulti->answer_id = $answer_id;

            if(!Yii::$app->user->isGuest){
                $modelMulti->user_id = Yii::$app->user->identity->id;
            }else{
                $modelMulti->user_id = $this->model->user_id;
            }

            if ( !$modelMulti->save() ) {
                $modelsaved = false;
                print_r( $modelMulti->errors );
                return false;
            } else {

                $modelsaved = true;
            }


        }
        return $modelsaved;
    }

    /**
     * set $model properties
     * @param type $model
     * @return type $model - PollsResult
     */
    private function setModel() {
        $this->model->poll_id = $this->pollsProvider->id;
        $this->model->num = PollsResult::getMaxNum( $this->pollsProvider->id );
        if ( !isset( $this->model->num ) ) {
            $this->model->num = 1;
        } else {
            $this->model->num++;
        }
        $this->model->create_at = date( "Y-m-d H:i:s" );
        $this->model->ip = Yii::$app->request->getUserIP();
        $this->model->host = Yii::$app->request->getUserHost();
        if ( $this->pollsProvider->anonymous ) {
            $this->model->scenario = PollsResult::SCENARIO_ANONYMOUS;
            $this->model->user_id = 0;
        } else {
            if ( !Yii::$app->user->isGuest ) {
                $this->model->user_id = Yii::$app->user->identity->id;
            }
        }
    }

    /**
     * Return poll for voting
     * @return type Polls
     */
    public function getProvider() {
        if ( isset( $this->idPoll ) ) {
            return Polls::getIdPoll( $this->idPoll );
        } else {
            $pollVote = Polls::getPollToday();
            if ( isset( $pollVote ) ) {
                $this->idPoll = $pollVote->id;
            }
            return $pollVote;
        }
    }

    /**
     *
     * @return string
     */
    public function run() {
        // Register AssetBundle
// Register AssetBundle
        //  PollAsset::register($this->getView());

        $this->model = new PollsResult();
        $this->pollsProvider = $this->getProvider();//barbaric of course
        if (!isset($this->pollsProvider)) {
            return;
        }
        $modelsaved = false;
        if ($this->model->load(Yii::$app->request->post())) {
            $this->setModel();
            /**
             * @todo I need do something with guest user. now i have user with ID=0;
             */
            if (is_array($this->model->answer_id)) {
                $modelsaved = $this->createResult();
            } else {
                $modelsaved = $this->model->save();
            }
        }
        if (!$modelsaved) {
            return $this->render('create', [
                'model' => $this->model,
                'pollsProvider' => $this->pollsProvider,]);

        }

        if (!$this->pollsProvider->show_vote) {
            return; //if show result wasn't allowed nothing would happen
        }
        $searchModel = new PollsResultSearch();
        $dataProvider = $searchModel->search(['poll_id' => $this->idPoll]);
        if (!isset($this->resultView)) {
            return $this->render('chart', ['dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'question' => $this->pollsProvider->question,
                'sumRes' => $this->model->num]);

        }
        return $this->render('table', ['dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'question' => $this->pollsProvider->question,
            'sumRes' => $this->model->num]);

    }

}