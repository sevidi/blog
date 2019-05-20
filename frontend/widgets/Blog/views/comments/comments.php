<?php
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $post \post\entities\Blog\Post\Post */
/* @var $items \frontend\widgets\Blog\CommentView[] */
/* @var $count integer */
/* @var $commentForm \post\forms\Blog\CommentForm */

?>

    <div id="comments" class="inner-bottom-xs">
        <h2>Comments</h2>
          <?php if(Yii::$app->user->isGuest): ?>
             <p>Комментирование доступно только для <?= Html::a('зарегистрированных', ['auth/signup/request'], ['class' => 'profile-link']) ?> польльзователей</p>
          <?php endif;?>

        <?php foreach ($items as $item): ?>
            <?= $this->render('_comment', ['item' => $item]) ?>
        <?php endforeach; ?>
    </div>
    <?php if(!Yii::$app->user->isGuest): ?>
    <div id="reply-block" class="leave-reply">
        <?php $form = ActiveForm::begin([
            'action' => ['comment', 'id' => $post->id],
        ]); ?>

        <?= Html::activeHiddenInput($commentForm, 'parentId') ?>
        <?= $form->field($commentForm, 'text')->textarea(['rows' => 5]) ?>

        <div class="form-group">
            <?= Html::submitButton('Send own comment', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
   <?php endif;?>
<?php $this->registerJs("
    jQuery(document).on('click', '#comments .comment-reply', function () {
        var link = jQuery(this);
        var form = jQuery('#reply-block');
        var comment = link.closest('.comment-item');
        jQuery('#commentform-parentid').val(comment.data('id'));
        form.detach().appendTo(comment.find('.reply-block:first'));
        return false;
    });

"); ?>