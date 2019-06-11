<?php

namespace backend\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use post\entities\Poll\Polls;

/**
 * PollsSearch represents the model behind the search form of `backend\models\Polls`.
 */
class PollsSearch extends Polls
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'allow_multiple', 'is_random', 'anonymous', 'show_vote'], 'integer'],
            [['question', 'date_beg', 'date_end'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Polls::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_beg' => $this->date_beg,
            'date_end' => $this->date_end,
            'allow_multiple' => $this->allow_multiple,
            'is_random' => $this->is_random,
            'anonymous' => $this->anonymous,
            'show_vote' => $this->show_vote,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question]);

        return $dataProvider;
    }
}
