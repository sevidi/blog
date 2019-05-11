<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Blog\LastPostsWidget;

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

    <div class="row">
        <div id="content" class="col-sm-12">
            <div id="slideshow0" class="owl-carousel" style="opacity: 1;">
                <div class="item">
                    <a href="index.php?route=product/product&amp;path=57&amp;product_id=49"><img
                            src="http://static.shop.dev/cache/banners/iPhone6-1140x380.jpg"
                            alt="iPhone 6" class="img-responsive"/></a>
                </div>
                <div class="item">
                    <img src="http://static.shop.dev/cache/banners/MacBookAir-1140x380.jpg"
                         alt="MacBookAir" class="img-responsive"/>
                </div>
            </div>
            <h3>Featured</h3>

            <?= FeaturedProductsWidget::widget([
                'limit' => 4,
            ]) ?>

            <h3>Last Posts</h3>

            <?= LastPostsWidget::widget([
                'limit' => 4,
            ]) ?>


            <?= $content ?>
        </div>
    </div>

<?php $this->endContent() ?>