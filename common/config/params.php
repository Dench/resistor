<?php
return [
    'sitename' => 'Resistor Yii2',
    'http' => 'http://www.resistor.ua',
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'langDef' => 2,
    'uploadSalePath' => dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'sale',
    'salePhotoBig' => [
        'width' => 1000,
        'height' => 760,
        'path' => '/photo/big/'
    ],
    'salePhotoSmall' => [
        'width' => 500,
        'height' => 380,
        'path' => '/photo/small/'
    ],
    'salePhotoThumb' => [
        'width' => 240,
        'height' => 180,
        'path' => '/photo/thumb/'
    ],
];
