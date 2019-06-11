<?php


namespace post\forms\poll;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use post\entities\Poll\PollsResult;

class PollsResultSearch extends PollsResult
{
    /**
     * @inheritdoc
     */
    public $answer;

    public function rules() {
        return [
            [['num', 'poll_id', 'answer_id'], 'integer'],
            [['answer'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {

        $query = PollsResult::find()
            ->select('answer_id, count(`answer_id`) as `res`')
            ->joinWith('idAnswer')
            ->groupBy(['answer_id'])
            ->where(['polls-result.poll_id'=>$params['poll_id']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

}