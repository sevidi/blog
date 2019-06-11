<?php

namespace backend\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use post\entities\Slider;


class SliderSearch extends Slider
{

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['id'], 'integer'],
            [['photo', 'alt', 'description'], 'safe'],
        ];
    }



    /**
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params):ActiveDataProvider
    {
        $query = Slider::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
           $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'alt', $this->alt])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
