<?php

/** @var $posts post\entities\Blog\Post\Post[] */

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<?php foreach ($posts as $post): ?>

    <article class="post" >
        <div class="post-content">
        <?php $url = Url::to(['/blog/post/post', 'id' =>$post->id]); ?>
            <div class="post-thumb">
                <?php if ($post->photo): ?>
                    <div class="image" style="margin-top: 40px">
                        <a href="<?= Html::encode($url) ?>">
                            <img src="<?= Html::encode($post->getThumbFileUrl('photo', 'widget_list')) ?>" alt="" class="img-responsive" />
                        </a>
                    </div>

                <?php endif; ?>


                    <div class="entry-header text-center">
                        <h5><a href="<?= Html::encode($url) ?>"><?= Html::encode($post->category->name) ?></a></h5>
                        <h4><a href="<?= Html::encode($url) ?>"><?= Html::encode($post->title) ?></a></h4>
                        <div class="entry-content">
                        <p><?= Html::encode(StringHelper::truncateWords(strip_tags($post->description), 20)) ?></p>
                            <span class="p-date">Автор: <?=$post->user->getFullName()?> <?= Html::encode(Yii::$app->formatter->format($post->created_at, 'date')) ?></span>
                            <ul class="text-center pull-right">
                                <li>
                                    <a class="s-facebook" href="#" title="Просмотров"><i class="fa fa-eye"></i></a> Просмотров:
                                    <?= $post->viewed?>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </article>
 <?php endforeach; ?>


