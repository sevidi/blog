<?php


namespace frontend\controllers;

use post\entities\Blog\Category as BlogCategory;
use post\entities\Blog\Post\Post;
use post\entities\Page;
use post\readModels\Blog\CategoryReadRepository as BlogCategoryReadRepository;
use post\readModels\Blog\PostReadRepository;
use post\readModels\PageReadRepository;
use post\services\sitemap\IndexItem;
use post\services\sitemap\MapItem;
use post\services\sitemap\Sitemap;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class SitemapController extends Controller
{
    const ITEMS_PER_PAGE = 100;

    private $sitemap;
    private $pages;
    private $blogCategories;
    private $posts;


    public function __construct(
        $id,
        $module,
        Sitemap $sitemap,
        PageReadRepository $pages,
        BlogCategoryReadRepository $blogCategories,
        PostReadRepository $posts,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->sitemap = $sitemap;
        $this->pages = $pages;
        $this->blogCategories = $blogCategories;
        $this->posts = $posts;
    }

    public function actionIndex(): Response
    {
        return $this->renderSitemap('sitemap-index', function () {
            return $this->sitemap->generateIndex([
                new IndexItem(Url::to(['pages'], true)),
                new IndexItem(Url::to(['blog-categories'], true)),
                new IndexItem(Url::to(['blog-posts-index'], true)),

            ]);
        });
    }

    public function actionPages(): Response
    {
        return $this->renderSitemap('sitemap-pages', function () {
            return $this->sitemap->generateMap(array_map(function (Page $page) {
                return new MapItem(
                    Url::to(['/page/view', 'id' => $page->id], true),
                    null,
                    MapItem::WEEKLY
                );
            }, $this->pages->getAll()));
        });
    }

    public function actionBlogCategories(): Response
    {
        return $this->renderSitemap('sitemap-blog-categories', function () {
            return $this->sitemap->generateMap(array_map(function (BlogCategory $category) {
                return new MapItem(
                    Url::to(['/blog/posts/category', 'slug' => $category->slug], true),
                    null,
                    MapItem::WEEKLY
                );
            }, $this->blogCategories->getAll()));
        });
    }

    public function actionBlogPostsIndex(): Response
    {
        return $this->renderSitemap('sitemap-blog-posts-index', function (){
            return $this->sitemap->generateIndex(array_map(function ($start) {
                return new IndexItem(Url::to(['blog-posts', 'start' => $start * self::ITEMS_PER_PAGE], true));
            }, range(0, (int)($this->posts->count() / self::ITEMS_PER_PAGE))));
        });
    }

    public function actionBlogPosts($start = 0): Response
    {
        return $this->renderSitemap(['sitemap-blog-posts', $start], function () use ($start) {
            return $this->sitemap->generateMap(array_map(function (Post $post) {
                return new MapItem(
                    Url::to(['/blog/post/post', 'id' => $post->id], true),
                    null,
                    MapItem::DAILY
                );
            }, $this->posts->getAllByRange($start, self::ITEMS_PER_PAGE)));
        });
    }


    private function renderSitemap($key, callable $callback): Response
    {
        return \Yii::$app->response->sendContentAsFile(\Yii::$app->cache->getOrSet($key, $callback), Url::canonical(), [
            'mimeType' => 'application/xml',
            'inline' => true
        ]);
    }

}