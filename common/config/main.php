<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ''=>'site/index',
                'about'=>'site/about',
                'contact'=>'site/contact',
                'login'=>'site/login',
                'logout'=>'site/logout',
                'signup'=>'site/signup',
                'request-password-reset'=>'site/request-password-reset',
                'reset-password'=>'site/reset-password',
                'country'=>'country/index',
                'personal'=>'personal/index',
            ]
        ],
    ],
];
