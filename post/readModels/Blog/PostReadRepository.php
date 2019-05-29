<?php


namespace post\readModels\Blog;

use post\entities\Blog\Category;
use post\entities\Blog\Post\Post;
use post\entities\Blog\Tag;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class PostReadRepository
{
    public function count(): int
    {
        return Post::find()->active()->count();
    }

    /**
     * @param $offset
     * @param $limit
     * @return array
     */
    public function getAllByRange($offset, $limit): array
    {
        return Post::find()->active()->orderBy(['id' => SORT_ASC])->limit($limit)->offset($offset)->all();
    }

    /**
     * @return DataProviderInterface
     */
    public function getAll(): DataProviderInterface
    {
        $query = Post::find()->active()->with('category');
        return $this->getProvider($query);
    }

    public function getAllByCategory(Category $category): DataProviderInterface
    {
        $query = Post::find()->active()->andWhere(['category_id' => $category->id])->with('category');
        return $this->getProvider($query);
    }

    public function getAllByTag(Tag $tag): DataProviderInterface
    {
        $query = Post::find()->alias('p')->active('p')->with('category');
        $query->joinWith(['tagAssignments ta'], false);
        $query->andWhere(['ta.tag_id' => $tag->id]);
        $query->groupBy('p.id');
        return $this->getProvider($query);
    }

    public function getLast($limit): array
    {
        return Post::find()->active()->with('category')->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    public function getPopular($limit): array
    {
        return Post::find()->active()->with('category')->orderBy(['viewed' => SORT_DESC])->limit($limit)->all();
    }

    /**
     * @param $id
     * @return Post|null
     */

    public function find($id): ?Post
    {
        return Post::find()->active()->andWhere(['id' => $id])->one();
    }

    public function PostSearch(Category $category): ActiveQuery
    {
        return Post::find()->active()->andWhere(['category_id' => $category->id])->with('category');
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);
    }

}