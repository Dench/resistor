<?php
return [
    'language' => 'ru',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity',
                'domain' => '.' . BASE_HOST,
                'httpOnly' => true,
                'path' => '/',
            ],
        ],
        'session' => [
            'cookieParams' => [
                'domain' => '.' . BASE_HOST,
                'httpOnly' => true,
                'path' => '/',
            ],
        ],
    ],
];
