<?php
return [
    'language' => 'ru',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'request' => [
            'class' => 'common\components\LangRequest'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class'=>'common\components\LangUrlManager',
            'rules' => [
                '<action:(login|logout|about|signup|contact|request-password-reset|reset-password)>' => 'site/<action>',
                '/' => 'site/index',
                'country' => 'country/index',
                'personal' => 'personal/index',
            ]
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'forceTranslation' => true,
                ],
            ],
        ],
    ],
];
