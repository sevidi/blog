<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Blog\CategoriesWidget;
use frontend\widgets\Blog\PopularPostsWidget;
?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

    <div class="row" >
        <div id="content" class="col-sm-9">
            <?= $content ?>
        </div>
        <aside id="column-left" class="col-sm-3 hidden-xs">
            <?= CategoriesWidget::widget([
                'active' => $this->params['active_category'] ?? null
            ]) ?>

         <div class="primary-sidebar">

          <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
            <div class="popular-post">
                <?= PopularPostsWidget::widget([
                    'limit' => 3,
                ]) ?>
            </div>

        </aside>
         </div>
        </aside>
     </div>

    </aside>
   </div>
<?php $this->endContent() ?>