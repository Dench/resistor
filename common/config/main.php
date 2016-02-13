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
                '<action:(login|logout|about|signup|contact|request-password-reset|reset-password)>' => 'site/<action>',
                ''=>'site/index',
                'country'=>'country/index',
                'personal'=>'personal/index',
            ]
        ],
    ],
];
