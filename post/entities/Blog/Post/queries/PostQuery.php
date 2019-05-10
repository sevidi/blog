<?php


namespace post\entities\Blog\Post\queries;


use post\entities\Blog\Post\Post;
use yii\db\ActiveQuery;

class PostQuery extends ActiveQuery
{
    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => Post::STATUS_ACTIVE,
        ]);
    }

}