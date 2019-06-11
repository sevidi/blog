<?php
/**
 * показать результаты. простая горизонтальная гистограмма
 */
use yii\bootstrap\Progress;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $question \post\entities\Poll\Polls*/


?>
<div class="polls-result-show">

    <h2><?= Html::encode($question) ?></h2>
    <h3><?= Html::encode("The results of the poll") ?></h3>

    <?php

    /**
     * sort function for array
     * @param type $a
     * @param type $b
     * @return int
     */
    function cmp($a, $b) {
        if ($a['res'] == $b['res']) {
            return 0;
        }
        return ($a['res'] > $b['res']) ? -1 : 1;
    }

    if (!is_array($dataProvider)) {
        $model = $dataProvider->getModels();
    } else {
        $model = $dataProvider;
    }
    $res = array();


    foreach ($model as $answer) {
        $res[] = ['answer' => $answer->idAnswer->answer, 'res' => $answer->res];
    }

    if (!isset($sumRes)) {
        $sumRes = 0;
        foreach ($model as $answer) {
            $sumRes += $answer->res;
        }
    }
    /**
     * sort result in
     */
    usort($res, "cmp");

    /**
     * Max value of polls, using for showing results
     * Maximum values has maximum bar
     * @var integer $maxVal Max value of polls, using for showing results
     */
    $maxVal = intval($res[0]['res']);

    if ($sumRes > 0) {
        foreach ($res as $val) {
            echo "<h3>" .  $val['answer'] . ":  " . $val['res'] . " (" . number_format($val['res'] / $sumRes * 100, 2) . "%)" . "</h3>";
            echo yii\bootstrap\Progress::widget([
                'percent' => intval($val['res']) / $maxVal * 100,
            ]);
        }
    }


    ?>

</div>