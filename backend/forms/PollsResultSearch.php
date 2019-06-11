<?php

namespace backend\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use post\entities\Poll\PollsResult as PollsResultModel;

/**
 * PollsResultSearch represents the model behind the search form of `backend\models\PollsResultSearch`.
 */
class PollsResultSearch extends PollsResultModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'poll_id', 'answer_id', 'user_id'], 'integer'],
            [['create_at', 'update_at', 'ip', 'host'], 'safe'],
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
        $query = PollsResultModel::find();


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
            'poll_id' => $this->poll_id,
            'answer_id' => $this->answer_id,
            'user_id' => $this->user_id,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'host', $this->host]);

        return $dataProvider;
    }
}
