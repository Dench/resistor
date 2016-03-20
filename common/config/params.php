<?php
return [
    'user.passwordResetTokenExpire' => 3600,
    'langDef' => 2,
    'uploadSalePath' => dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'sale',
    'salePhotoMin' => [
        'width' => 600,
        'height' => 450,
    ],
    'salePhotoBig' => [
        'width' => 900,
        'height' => 450,
        'path' => '/photo/big/'
    ],
    'salePhotoSmall' => [
        'width' => 600,
        'height' => 450,
        'path' => '/photo/small/'
    ],
    'salePhotoThumb' => [
        'width' => 260,
        'height' => 195,
        'path' => '/photo/thumb/'
    ],
];
