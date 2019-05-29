<?php


namespace post\readModels\Blog;

use post\entities\Blog\Category;


class SearchReadRepository
{
    public function getAll($q): array
    {
        return Category::find()->where(['like', 'name', $q])->orderBy('sort')->all();
    }


    /**
     * @param $q
     * @return Category|null
     */
    public function find($q): ?Category
    {
        return Category::find($q)->where(['like', 'name', $q])->one();
    }

    /**
     * @param $slug
     * @return array|Category|\yii\db\ActiveRecord|null
     */
    public function findBySlug($q)
    {
        return Category::find()->andWhere(['like', 'name', $q])->one();
    }

}