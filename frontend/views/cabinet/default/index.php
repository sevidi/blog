<?php

/* @var $this yii\web\View */
/* @var $model post\forms\manage\User\UserEditForm */
/* @var $user post\entities\User\User */

use post\entities\User\User;
use post\forms\manage\User\UserEditForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$this->title = 'Кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container profile-user" >
    <article class="post-content">
    <h1><?= Html::encode($this->title)?> <?= $user->username?></h1>

    <p>
        <?= Html::a('Редактировать профиль', ['cabinet/profile/edit'], ['class' => 'btn btn-primary']) ?>
    </p>


        <h3>Профиль</h3>


        <table class="table table-striped">

            <tbody>
            <tr>
                <td>Фото</td>
                <td><img src="<?= Html::encode($user->getThumbFileUrl('photo', 'user')) ?>" alt="" class="img-responsive" /></td>

            </tr>
            <tr>
                <td>Email</td>
                <td><?= $user->email?></td>

            </tr>
            <tr>
                <td>Фамилия</td>
                <td><?= $user->last_name?></td>

            </tr>
            <tr>
                <td>Имя</td>
                <td><?= $user->first_name?></td>

            </tr>
            <tr>
                <td>Дата рождения</td>
                <td><?= $user->birthday?></td>

            </tr>
            </tbody>
        </table>


    <h2>Attach profile</h2>
    <?= yii\authclient\widgets\AuthChoice::widget([
        'baseAuthUrl' => ['cabinet/network/attach'],
    ]); ?>
    </div>
 </article>