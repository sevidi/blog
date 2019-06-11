<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \post\entities\Poll\PollsResult */

$this->title = 'Create Polls Result';
$this->params['breadcrumbs'][] = ['label' => 'Polls Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polls-result-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
