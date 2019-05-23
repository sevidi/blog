<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <!--[if IE]><![endif]-->
    <!--[if IE 8 ]>
    <html dir="ltr" lang="en" class="ie8"><![endif]-->
    <!--[if IE 9 ]>
    <html dir="ltr" lang="en" class="ie9"><![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!-->
    <html lang="<?= Yii::$app->language ?>">
    <!--<![endif]-->
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical"/>
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="image/icon.png">
        <?php $this->head() ?>

    </head>

    <body>
    <?php $this->beginBody() ?>
    <header>
        <nav class="navbar main-menu navbar-default navbar-menu-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div id="logo">
                            <a href="<?= Url::home() ?>"><img
                                        src="<?= Yii::getAlias('@web/image/logo.png') ?>" title="Your Store"
                                        alt="Your Store"
                                        class="img-logo"/></a>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <?= Html::beginForm(['/core/catalog/search'], 'get') ?>
                        <div id="search" class="input-group">
                            <input type="text" name="text" value="" placeholder="Search" class="form-control input-lg"/>
                            <span class="input-group-btn">
                        <button type="submit" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>

                    </span>
                        </div>
                        <?= Html::endForm() ?>
                    </div>
                </div>
            </div>
            <nav>
                <?php
                NavBar::begin([
                    'options' => [
                        'screenReaderToggleText' => 'Menu',
                        'id' => 'menu',
                        'class' => 'navbar-inverse',

                    ],
                ]);
                $menuItems = [
                    ['label' => 'Главная', 'url' => ['/site/index']],
                    ['label' => 'Статьи', 'url' => ['/blog/post/index']],
                    ['label' => 'Обо мне', 'url' => ['/view/about']],
                    ['label' => 'Контакты', 'url' => ['/contact/index']],
                ];
                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => 'Регистрация', 'url' => ['/auth/signup/request']];
                    $menuItems[] = ['label' => 'Вход', 'url' => ['/auth/auth/login']];
                } else {
                    $menuItems[] = ['label' => 'Личный кабинет', 'url' => ['/cabinet/default/index']];
                    $menuItems[] = '<li>'
                        . Html::beginForm(['/auth/auth/logout'], 'post')
                        . Html::submitButton(
                            'Выход (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link  navbar-inverse navbar navbar-nav nav logout']
                        )
                        . Html::endForm()
                        . '</li>';

                }
                echo Nav::widget([
                    'options' => [
                        'class' => 'navbar navbar-nav',
                    ],
                    'items' => $menuItems,
                ]);
                NavBar::end();
                ?>
            </nav>


    </header>
    <div class="main-content">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
    <!--footer start-->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h5>Information</h5>
                    <ul class="list-unstyled">
                        <li><a href="/index.php?route=information/information&amp;information_id=4">About
                                Us</a></li>
                        <li><a href="/index.php?route=information/information&amp;information_id=6">Delivery
                                Information</a></li>
                        <li><a href="/index.php?route=information/information&amp;information_id=3">Privacy
                                Policy</a></li>
                        <li><a href="/index.php?route=information/information&amp;information_id=5">Terms
                                &amp; Conditions</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="/index.php?route=information/contact">Contact Us</a></li>
                        <li><a href="/index.php?route=account/return/add">Returns</a></li>
                        <li><?= Html::a('Site Map', ['/sitemap']) ?></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Extras</h5>
                    <ul class="list-unstyled">
                        <li><a href="/index.php?route=product/manufacturer">Brands</a></li>
                        <li><a href="/index.php?route=account/voucher">Gift Certificates</a></li>
                        <li><a href="/index.php?route=affiliate/account">Affiliates</a></li>
                        <li><a href="/index.php?route=product/special">Specials</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>My Account</h5>
                    <ul class="list-unstyled">
                        <li><a href="/index.php?route=account/account">My Account</a></li>
                        <li><a href="/index.php?route=account/order">Order History</a></li>
                        <li><a href="/index.php?route=account/wishlist">Wish List</a></li>
                        <li><a href="/index.php?route=account/newsletter">Newsletter</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <p>Сайт разработан <a href="http://creativsv.ru">&copy; Смирновым В.И.</a> в 2019 году</p>
        </div>
    </footer>
    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>