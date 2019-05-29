<?php
/* @var $this yii\web\View */

/* @var $model post\entities\Blog\Post\Post */

use yii\helpers\Html;
use yii\helpers\Url;


$url = Url::to(['search', 'id' => $model->q]);
?>
<article class="post post-list">
    <div class="row">
        <h2 class="title text-center">Поиск по запросу: <?= Html::encode($q)?></h2>
        <?php if ($model->photo): ?>
            <div class="col-md-6">
                <div class="post-thumb">
                    <a href="<?= Html::encode($url) ?>">
                        <img src="<?= Html::encode($model->getThumbFileUrl('photo', 'blog_list')) ?>" alt=""
                             class="img-responsive"/>
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <div class="post-content">
                <header class="entry-header text-uppercase">
                    <h4><a href="<?= Html::encode($url) ?>"><?= Html::encode($model->title) ?></a></h4>
                </header>
                <div class="entry-content">
                    <p><?= Yii::$app->formatter->asNtext($model->description) ?></p>
                    <span class="social-share-title pull-left text-capitalize">Автор: <?= $model->user->username; ?>  <?= Html::encode(Yii::$app->formatter->format($model->created_at, 'date')) ?></span>
                    <ul class="text-center pull-right" style="margin-top: 12px">
                        <li>
                            <a class="s-facebook" href="#" title="Просмотров"><i class="fa fa-eye"></i></a>
                            <?= (int)$model->viewed ?>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>