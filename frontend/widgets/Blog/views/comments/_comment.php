<?php

/* @var $item \frontend\widgets\Blog\CommentView */


use yii\helpers\Html;
?>

<div class="comment-item" data-id="<?= $item->comment->id ?>">
    <div class="comment-img">
     <?= Html::img('@static/cache/users/user_'.$item->comment->user->id.'.jpg', ['alt' => $item->comment->user->username, 'class' => 'float-left img-circle', 'width' => '50%']) ?>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <h5><?=$item->comment->user->username?></h5>
            <p class="comment-content">
                <?php if ($item->comment->isActive()): ?>
                    <?= Yii::$app->formatter->asNtext($item->comment->text) ?>
                <?php else: ?>
                    <i>Comment is deleted.</i>
                <?php endif; ?>
            </p>
            <div>
                <div class="pull-left">
                    <?= Yii::$app->formatter->asDatetime($item->comment->created_at) ?>

                </div>
                <div class="pull-right">
                    <span class="comment-reply">Ответить</span>
                </div>
            </div>
        </div>
    </div>

    <div class="margin">
        <div class="reply-block"></div>
        <div class="comments">
            <?php foreach ($item->children as $children): ?>
                <?= $this->render('_comment', ['item' => $children]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
