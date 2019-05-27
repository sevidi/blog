<?php

use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model post\forms\manage\User\UserCreateForm */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'photo')->label(false)->widget(FileInput::class, [
        'options' => [
            'accept' => 'image/*',
        ]
    ]) ?>
    <?= $form->field($model, 'last_name')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'first_name')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'birhday')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'role')->dropDownList($model->rolesList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
