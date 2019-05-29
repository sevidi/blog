<?php


namespace frontend\controllers\blog;

use post\entities\Blog\Category;
use post\entities\Blog\Post\Post;
use post\forms\Blog\CommentForm;
use post\readModels\Blog\CategoryReadRepository;
use post\readModels\Blog\PostReadRepository;
use post\readModels\Blog\TagReadRepository;
use post\readModels\Blog\SearchReadRepository;
use post\services\Blog\CommentService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
 ;

class PostController extends Controller
{
    public $layout = 'blog';

    private $service;
    private $posts;
    private $categories;
    private $tags;
    private $searchs;


    public function __construct(
        $id,
        $module,
        CommentService $service,
        PostReadRepository $posts,
        CategoryReadRepository $categories,
        TagReadRepository $tags,
        SearchReadRepository $searchs,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->posts = $posts;
        $this->categories = $categories;
        $this->tags = $tags;
        $this->searchs = $searchs;

    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = $this->posts->getAll();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $slug
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCategory($slug)
    {
        if (!$category = $this->categories->findBySlug($slug)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->posts->getAllByCategory($category);
        return $this->render('category', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $slug
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionTag($slug)
    {
        if (!$tag = $this->tags->findBySlug($slug)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->posts->getAllByTag($tag);
        return $this->render('tag', [
            'tag' => $tag,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionPost($id)
    {
        if (!$post = $this->posts->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $post->viewedCounter();

        return $this->render('post', [
            'post' => $post,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionComment($id)
    {
        if (!$post = $this->posts->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $form = new CommentForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $comment = $this->service->create($post->id, Yii::$app->user->id, $form);
                return $this->redirect(['post', 'id' => $post->id, '#' => 'comment_' . $comment->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('comment', [
            'post' => $post,
            'model' => $form,
        ]);
    }

    public function actionSearch()
    {
        $q = trim(Yii::$app->request->get('q'));
        if (!$search = $this->searchs->getAll($q)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->posts->getAllByCategory($search);
        return $this->render('search', [
            'search' => $search,
            'dataProvider' => $dataProvider,
        ]);


    }

}