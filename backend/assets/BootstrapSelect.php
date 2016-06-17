<?php

namespace backend\assets;

use yii\web\AssetBundle;

class BootstrapSelect extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-select/dist';
    public $css = [
        'css/bootstrap-select.min.css',
    ];
    public $js = [
        'js/bootstrap-select.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
