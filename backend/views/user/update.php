<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $model post\forms\manage\User\UserEditForm */
/* @var $user post\entities\User\User */


$this->title = 'Update User: ' . $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'photo')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'last_name')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'first_name')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'birhday')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'role')->dropDownList($model->rolesList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
