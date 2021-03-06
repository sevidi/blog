<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \post\forms\auth\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход на сайт';
$this->params['breadcrumbs'][] = $this->title;
?>

<article class="post-content profile-user">
    <div class="row">
        <div class="site-login">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Пожалуйста, заполните следующие поля для входа:</p>
            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div style="color:#999;margin:1em 0">
                        Если вы забыли свой пароль, вы можете  <?= Html::a('сбросить его', ['auth/reset/request']) ?>.
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                    <h2>Socials</h2>
                    <?= yii\authclient\widgets\AuthChoice::widget([
                        'baseAuthUrl' => ['auth/network/auth']
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</article>

