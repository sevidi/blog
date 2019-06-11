<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \post\entities\Poll\Polls */

$this->title = 'Create Polls';
$this->params['breadcrumbs'][] = ['label' => 'Polls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
    'pollsProvider' => $pollsProvider
]) ?>

