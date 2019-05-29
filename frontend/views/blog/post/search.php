<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category post\entities\Blog\Category */


use yii\helpers\Html;

$this->title = 'Search';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_list-search', [
    'dataProvider' => $dataProvider
]) ?>