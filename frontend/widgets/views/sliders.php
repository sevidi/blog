<?php
/** @var $sliders post\entities\Slider[] */

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

?>
<div id="slideshow0" class="owl-carousel" style="opacity: 1; margin-bottom: 40px">
    <?php foreach ($sliders as $slider): ?>
        <div class="item">
            <?php $url = Url::to(['/blog/post/post', 'id' => $slider->id]); ?>

            <?php if ($slider->photo): ?>
                <div class="image">
                    <a href="<?= Html::encode($url) ?>">
                        <img src="<?= Html::encode($slider->getThumbFileUrl('photo', 'slider')) ?>" alt=""
                             class="img-responsive"/>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

