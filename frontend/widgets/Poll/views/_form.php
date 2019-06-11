<?php
use post\entities\Poll\PollsAnswers;
use post\entities\Poll\PollsResult;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="polls-result-form">

    <?php



    $form = ActiveForm::begin();



    echo "<h1>" . $pollsProvider->question . "</h1>";


    $answersProvider = PollsAnswers::find()
        ->where('poll_id=:id', ['id' => $pollsProvider->id])
        ->all();
    $answer = ArrayHelper::map($answersProvider, 'id', 'answer');

    if ($pollsProvider->is_random) {
        $answer = PollsAnswers::getShuffleAssoc($answer);
    }

    if ($pollsProvider->allow_multiple) {
        echo $form->field($model, 'answer_id')
            ->checkBoxList($answer, ['separator' => '</br>'])
            ->label();
    } else {
        echo $form->field($model, 'answer_id')
            ->radioList($answer, ['separator' => '</br>'])
            ->label();
    }
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Send' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php
    ActiveForm::end();
    ?>
</div>