<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \post\forms\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="post-content profile-user">

    <div class="site-contact">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            Если у вас есть деловые или другие вопросы, пожалуйста, заполните следующую форму, чтобы связаться с нами. Спасибо.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Имя') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject')->label('Тема') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6])->label('Текст сообщения') ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3" >{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</article>
