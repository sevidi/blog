<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

/* @var $category post\entities\Blog\Category */


use yii\helpers\Html;

$this->title = 'Search';
if (isset($search1)) {

    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->params['breadcrumbs'][] = $this->title;
}

?>

<article class="post">

    <div class="post-content">
        <header class="entry-header text-uppercase">
            <h2 class="title text-center">Поиск по запросу: <span
                        style="color: darkgreen"><?= Html::encode($search1) ?></span></h2>
        </header>

    </div>
</article>
<?= $this->render('_list-search', [
    'dataProvider' => $dataProvider
]) ?>
