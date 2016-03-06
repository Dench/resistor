<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class FontAwesome extends AssetBundle
{
    public $sourcePath = '@bower/fontawesome';
    public $css = [
        'css/font-awesome.min.css',
    ];
    public $js = [
    ];
    public $depends = [
    ];
}
