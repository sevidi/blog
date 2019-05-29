<?php
/** @var $sliders post\entities\Slider[] */

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

?>
<div id="slideshow0" class="owl-carousel" style="opacity: 1; margin-bottom: 40px">
    <?php foreach ($sliders as $slider): ?>
        <div class="item">

            <?php if ($slider->photo): ?>
                <div class="image">
                    <img src="<?= Html::encode($slider->getThumbFileUrl('photo', 'slider')) ?>"
                         alt="<?= $slider->alt ?>" class="img-responsive"/>
                    <span class="slider-post" style=""><?= Html::encode($slider->description) ?></span>

                </div>

            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

