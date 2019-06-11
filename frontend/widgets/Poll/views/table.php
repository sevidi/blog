<?php

use yii\grid\GridView;
use yii\helpers\Html;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* @var $this yii\web\View */
/* @var $question \post\entities\Poll\Polls*/
?>
<div class="polls-result-show">
    <h2><?= Html::encode($question) ?></h2>
    <h3><?= Html::encode("The results of the poll") ?></h3>


    <?
    /**
     * @todo get rid of number of records
     */
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'idAnswer.answer',
                'value' => 'idAnswer.answer',
                'label' =>  'Answer'],
            ['attribute' => 'res',
                'value' => 'res',
                'label' =>  'Results'],
        ],
    ]);
    ?>

</div>
