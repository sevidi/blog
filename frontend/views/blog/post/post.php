<?php
/* @var $this yii\web\View */
/* @var $post post\entities\Blog\Post\Post */

use frontend\widgets\Blog\CommentsWidget;
use yii\helpers\Html;


$this->title = $post->getSeoTitle();

$this->registerMetaTag(['name' =>'description', 'content' => $post->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $post->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $post->category->name, 'url' => ['category', 'slug' => $post->category->slug]];
$this->params['breadcrumbs'][] = $post->title;

$this->params['active_category'] = $post->category;

$tagLinks = [];
foreach ($post->tags as $tag) {
    $tagLinks[] = Html::a(Html::encode($tag->name), ['tag', 'slug' => $tag->slug]);
}
?>

<article class="post">
   <div class="post-content">
    <h1><?= Html::encode($post->title) ?></h1>

    <p><span class="glyphicon glyphicon-calendar"></span> <?= Yii::$app->formatter->asDatetime($post->created_at); ?></p>

    <?php if ($post->photo): ?>
        <p><img src="<?= Html::encode($post->getThumbFileUrl('photo', 'origin')) ?>" alt="" class="img-responsive" ></p>
    <?php endif; ?>
    <?= Yii::$app->formatter->asHtml($post->content, [
        'Attr.AllowedRel' => array('nofollow'),
        'HTML.SafeObject' => true,
        'Output.FlashCompat' => true,
        'HTML.SafeIframe' => true,
        'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
    ]) ?>

    <div class="entry-header">
        Tags: <?= implode(', ', $tagLinks) ?>
    </div>
       <div class="social-share">
		<span class="social-share-title pull-left text-capitalize">Автор: <?=$post->user->username;?></span>

           <ul class="text-center pull-right">
               <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
               <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
               <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
               <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
               <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
           </ul>
       </div>
   </div>
</article>

<?= CommentsWidget::widget([
    'post' => $post,
]) ?>