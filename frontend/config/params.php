<?php
return [
    'adminEmail' => 'admin@example.com',
    'watermark' => [
        'file' => dirname(dirname(__DIR__)).
            DIRECTORY_SEPARATOR.'frontend'.DIRECTORY_SEPARATOR.'web'.
            DIRECTORY_SEPARATOR.'watermark.png',
        'x' => 20,
        'y' => 15
    ],
    'watermark_thumb' => [
        'file' => dirname(dirname(__DIR__)).
            DIRECTORY_SEPARATOR.'frontend'.DIRECTORY_SEPARATOR.'web'.
            DIRECTORY_SEPARATOR.'watermark_thumb.png',
        'x' => 20,
        'y' => 15
    ],
];
