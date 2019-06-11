<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \post\entities\Poll\PollsAnswers */

$this->title = 'Create Polls Answers';
$this->params['breadcrumbs'][] = ['label' => 'Polls Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polls-answers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
