<?php
return [
    'sitename' => 'Cyprus',
    'http' => 'http://www.resistor.ua',
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'langDef' => 2,
    'uploadSalePath' => dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'sale',
    'salePhotoMin' => [
        'width' => 640,
        'height' => 480,
    ],
    'salePhotoBig' => [
        'width' => 1000,
        'height' => 760,
        'path' => '/photo/big/'
    ],
    'salePhotoSmall' => [
        'width' => 850,
        'height' => 400,
        'path' => '/photo/small/'
    ],
    'salePhotoThumb' => [
        'width' => 260,
        'height' => 195,
        'path' => '/photo/thumb/'
    ],
];
