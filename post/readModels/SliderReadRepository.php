<?php


namespace post\readModels;

use post\entities\Slider;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class SliderReadRepository
{
    public function getAll():array
    {
        return Slider::find()->all();
    }

    public function find($id): ?Slider
    {
        return Slider::findOne($id);
    }

    public function getSlider($limit):array
    {
        return Slider::find()->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);
    }

}