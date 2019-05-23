<?php

/* @var $this yii\web\View */

/* @var $content string */

use frontend\widgets\Blog\LastPostsWidget;
use frontend\widgets\Blog\PopularPostsWidget;
use frontend\widgets\Blog\CategoriesWidget;

\frontend\assets\OwlCarouselAsset::register($this);

$this->title = 'SHATILIN';
?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

    <div class="main-content">
    <div class="row">
        <div id="slideshow0" class="owl-carousel" style="opacity: 1; margin-bottom: 40px">
            <div class="item">
                <img src="http://static.blog.com/cache/banners/shatilin1.jpg"
                     alt="iPhone 6" class="img-responsive">
            </div>
            <div class="item">
                <img src="http://static.blog.com/cache/banners/shatilin2.jpg"
                     alt="MacBookAir" class="img-responsive">
            </div>
            <div class="item">
                <img src="http://static.blog.com/cache/banners/shatilin3.jpg"
                     alt="MacBookAir" class="img-responsive">
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <?= LastPostsWidget::widget([
                    'limit' => 4,
                ]) ?>

            </div>
            <div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">

                    <aside class="widget">
                        <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>

                        <?= PopularPostsWidget::widget([
                            'limit' => 3,
                        ]) ?>

                    </aside>

                    <aside class="widget border pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Categories</h3>
                        <?= CategoriesWidget::widget([

                        ]) ?>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <!-- end main content-->
<?php $this->registerJs('
$(\'#slideshow0\').owlCarousel({
    items: 1,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,  
    dots: true
});') ?>
<?php $this->endContent() ?>