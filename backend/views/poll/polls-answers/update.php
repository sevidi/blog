<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \post\entities\Poll\PollsAnswers */

$this->title = 'Update Polls Answers: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Polls Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="polls-answers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
