<?php

namespace post\entities\Poll;

use Yii;
use post\entities\User\User;
use post\entities\Poll\queries\PollsResultQuery;
use post\entities\Poll\PollsAnswers;



/**
 * This is the model class for table "polls-result".
 *
 * @property int $id
 * @property int $poll_id
 * @property int $answer_id
 * @property int $user_id
 * @property string $create_at
 * @property string $update_at
 * @property string $ip
 * @property string $host
 *
 * @property User $user
 */
class PollsResult extends \yii\db\ActiveRecord
{
    /**
     * @const field allow_multiple in polls is true
     */
    public $res;

    const SCENARIO_MULTIPLE = 'allow_multiple';

    /**
     * @const field allow_multiple in polls is false
     */
    const SCENARIO_SINGLE = 'not_allow_multiple';

    /**
     * @const can vote without sign up
     *
     */
    const SCENARIO_ANONYMOUS = 'anonymous';

    public static function tableName()
    {
        return '{{%polls-result}}';
    }

    /**
     * @inheritdoc
     *
     */
    public function rules() {
        return [
            [['num', 'poll_id', 'answer_id', 'user_id'], 'integer', 'on' => 'default'],
            [['poll_id', 'answer_id', 'user_id'], 'required', 'on' => 'default'],
            [['create_at'], 'date', 'format' => 'php:Y-m-d H:i:s', 'on' => ['default', self::SCENARIO_ANONYMOUS]],
            [['ip'], 'ip', 'on' => ['default', self::SCENARIO_ANONYMOUS]],
            [['host'], 'string', 'length' => [0, 20], 'on' => ['default', self::SCENARIO_ANONYMOUS]],
            [['num', 'poll_id', 'answer_id'], 'integer', 'on' => self::SCENARIO_ANONYMOUS],
            [['poll_id', 'answer_id'], 'required', 'on' => self::SCENARIO_ANONYMOUS],
        ];
    }

    /**
     * @inheritdoc
     * @todo change 'app'/'polls'
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'poll_id' => 'Poll ID',
            'answer_id' => 'Answer ID',
            'user_id' => 'User ID',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'ip' => 'Ip',
            'host' => 'Host',
        ];
    }

    /**
     * @inheritdoc
     * @return PollsResultQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PollsResultQuery(get_called_class());
    }

    /**
     * Return record from polls_answer with predefined id
     * @return \yii\db\ActiveQuery
     */
    public function getIdAnswer()
    {
        return $this->hasOne(PollsAnswers::className(), ['id' => 'answer_id']);
    }

    /**
     * Return text of answer
     * @return type string
     */
    public function getAnswer()
    {
        return $this->idAnswer->answer;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Return all polls results for certain poll
     * @param type $poll_id
     * @return array|PollsResult[]
     */
    public static function getPollsId($poll_id)
    {
        return self::find()
            ->where('poll_id=:poll_id', ['poll_id' => $poll_id])
            ->all();
    }

    /**
     * Return max value of field num -
     * amount of voting for multiple answers
     * @param type $poll_id integer -
     * @return type integer
     */
    public static function getMaxNum($poll_id)
    {
        return self::find()
            ->where('poll_id=:poll_id', ['poll_id' => $poll_id])
            ->max('num');
    }

    /**
     * Return joined number of records
     * @param integer $poll_id
     * @return PollsResultQuery
     */
    public static function getResults($poll_id)
    {
        return self::find()
            ->select('answer_id, count(`answer_id`) as `res`')
            ->where(['polls-result.poll_id:=poll_id', ['poll_id' => $poll_id]])
            ->joinWith('idAnswer')
            ->groupBy(['answer_id']);
    }
}
