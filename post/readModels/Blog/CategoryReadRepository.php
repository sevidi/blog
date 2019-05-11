<?php


namespace post\readModels\Blog;

use post\entities\Blog\Category;

class CategoryReadRepository
{
    public function getAll(): array
    {
        return Category::find()->orderBy('sort')->all();
    }

    public function find($id): ?Category
    {
        return Category::findOne($id);
    }

    /**
     * @param $slug
     * @return Category|null
     */
    public function findBySlug($slug): ?Category
    {
        return Category::find()->andWhere(['slug' => $slug])->one();
    }

}