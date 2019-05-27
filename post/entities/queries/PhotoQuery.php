<?php


namespace post\entities\queries;

use post\entities\Slider;
use yii\db\ActiveQuery;

class PhotoQuery extends ActiveQuery
{
    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => Slider::STATUS_ACTIVE,
        ]);
    }

}