<?php

namespace post\entities\Poll;

use post\entities\Poll\PollsAnswers;
use post\entities\Poll\queries\PollsQuery;
use Yii;

/**
 * This is the model class for table "polls".
 *
 * @property int $id
 * @property string $question
 * @property string $date_beg
 * @property string $date_end
 * @property int $allow_multiple
 * @property int $is_random
 * @property int $anonymous
 * @property int $show_vote
 * @property int $status
 *
 * @property PollsAnswers[] $pollsAnswers
 */
class Polls extends \yii\db\ActiveRecord
{

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'polls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question', 'date_beg', 'date_end', 'allow_multiple', 'is_random', 'anonymous', 'show_vote', 'status'], 'required'],
            [['date_beg', 'date_end'], 'safe'],
            [['allow_multiple', 'is_random', 'anonymous', 'show_vote', 'status'], 'integer'],
            [['question'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'date_beg' => 'Date Beg',
            'date_end' => 'Date End',
            'allow_multiple' => 'Allow Multiple',
            'is_random' => 'Is Random',
            'anonymous' => 'Anonymous',
            'show_vote' => 'Show Vote',
            'status' => 'Status'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollsAnswers() {
        return $this->hasMany(PollsAnswers::className(), ['poll_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PollsQuery the active query used by this AR class.
     */
    public static function find() {
        return new PollsQuery(get_called_class());
    }

    /**
     * Return polls which are active today (date_beg>=today <=date_end
     * @param type $date - today date
     */
    public static function getPollsDate($date) {
        return self::find()
            ->where('date_beg<=:dateToday', ['dateToday' => $date])
            ->andWhere('date_end>=:dateToday', ['dateToday' => $date])
            ->all();
    }

    /**
     * Returns poll which is active today
     * @return type poll which is active today
     */
    public static function getPollToday() {
        return self::find()
            ->where('date_beg<=:dateToday', ['dateToday' => date('Y-m-d')])
            ->andWhere('date_end>=:dateToday', ['dateToday' => date('Y-m-d')])
            ->one();
    }


    public static function getIdPoll($poll_id) {
        return self::find()
            ->where('id=:poll_id', ['poll_id' => $poll_id])
            ->one();
    }
}
