<?php


namespace frontend\widgets\Blog;

use post\readModels\Blog\PostReadRepository;
use yii\base\Widget;

class PopularPostsWidget extends Widget
{
    public $limit;

    private $repository;

    public function __construct(PostReadRepository $repository, $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run(): string
    {
        return $this->render('popular-posts', [
            'posts' => $this->repository->getPopular($this->limit)
        ]);
    }

}