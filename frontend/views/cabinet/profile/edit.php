<?php

/* @var $this yii\web\View */
/* @var $model post\forms\manage\User\UserEditForm */
/* @var $user post\entities\User\User */

use kartik\file\FileInput;
use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = 'Редактирование профиля';
$this->params['breadcrumbs'][] = ['label' => 'Cabinet', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = 'Profile';
?>
<div class="container profile-user">
<div class="user-update">
    <h1><?= Html::encode($this->title)?> <?= $user->username?></h1>
    <div class="row">
        <div class="col-sm-6">

            <?php $form =  ActiveForm::begin([
                'options' => ['enctype'=>'multipart/form-data']
            ]); ?>

            <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>
            <?= $form->field($model, 'phone', ['addon' => ['prepend' => ['content'=>'+']]])->textInput(['maxLength' => true]) ?>
            <div class="box box-default" style="margin: 30px 0">
            <?= $form->field($model, 'photo')->label('Slider')->widget(FileInput::class, [
                        'options' => [
                            'accept' => 'image/*',
                        ]
                    ]) ?>
            </div>

            <?= $form->field($model, 'last_name')->textInput(['maxLength' => true]) ?>
            <?= $form->field($model, 'first_name')->textInput(['maxLength' => true]) ?>
            <?= $form->field($model, 'birthday')->textInput(['maxLength' => true]) ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

