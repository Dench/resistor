<?php
return [
    'baseHost' => BASE_HOST,
    'adminEmail' => 'admin@' . BASE_HOST,
    'user.passwordResetTokenExpire' => 3600,
    'langDef' => 2,
    
    'uploadSalePath' => dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'sale',
    'salePhotoMin' => [
        'width' => 100,
        'height' => 100,
    ],
    'salePhotoSlider' => [
        'width' => 900,
        'height' => 450,
        'path' => '/photo/slider/'
    ],
    'salePhotoBig' => [
        'width' => 1024,
        'height' => 768,
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

    'uploadOfferPath' => dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'offer',
    'offerPhotoMin' => [
        'width' => 100,
        'height' => 100,
    ],
    'offerPhotoSlider' => [
        'width' => 900,
        'height' => 450,
        'path' => '/photo-offer/slider/'
    ],
    'offerPhotoBig' => [
        'width' => 1024,
        'height' => 768,
        'path' => '/photo-offer/big/'
    ],
    'offerPhotoSmall' => [
        'width' => 600,
        'height' => 450,
        'path' => '/photo-offer/small/'
    ],
    'offerPhotoThumb' => [
        'width' => 260,
        'height' => 195,
        'path' => '/photo-offer/thumb/'
    ],
];
