<?php
/* @var $this yii\web\View */
/* @var $model \post\entities\Poll\PollsResult*/
/* @var $pollsProvider \post\entities\Poll\PollsResult*/
?>

<div class="polls-result-create">



    <?php



    echo $this->render( '_form', [

        'model' => $model,
        'pollsProvider' => $pollsProvider
    ])
    ?>

</div>

