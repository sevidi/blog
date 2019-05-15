<?php
/** @var $posts post\entities\Blog\Post\Post[] */

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<?php foreach ($posts as $post): ?>

    <div class="popular-post">
          <?php $url = Url::to(['/blog/post/post', 'id' =>$post->id]); ?>

            <?php if ($post->photo): ?>

                <a href="<?= Html::encode($url);?>">
                   <img src="<?= Html::encode($post->getThumbFileUrl('photo', 'widget_list')) ?>" alt="" class="img-responsive" />
                </a>

            <?php endif; ?>


        <div class="p-content">

            <a href="<?=Html::encode($url) ?>" class="text-uppercase"><?= Html::encode($post->title) ?></a>
            <span class="p-date"><?= Html::encode(Yii::$app->formatter->format($post->created_at, 'date')) ?></span>

        </div>
    </div>

<?php endforeach; ?>