<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class BootstrapSliderAsset extends AssetBundle
{
    public $sourcePath = '@bower/seiyria-bootstrap-slider/dist/';
    public $css = [
        'css/bootstrap-slider.min.css',
    ];
    public $js = [
        'bootstrap-slider.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
