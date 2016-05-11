<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'class' => 'common\components\LangRequest'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class'=>'common\components\LangUrlManager',
            'rules' => [
                '<action:(login|logout|agent|about|signup|contact|request-password-reset|reset-password)>' => 'site/<action>',
                '/' => 'site/index',
                'personal' => 'personal/index',
                'sale/<id:\d+>' => 'sale/index',
                'photo/<action:(slider|big|small|thumb)>/<id:\d+>.jpg' => 'photo/<action>',
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
    'params' => $params,
];
