<?php
use yii\helpers\ReplaceArrayValue;

return [
    'id' => 'app-common-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'post\entities\User\User',
            'identityCookie' => new ReplaceArrayValue(['name' => '_identity', 'httpOnly' => true]),
        ],
    ],
];
