<?php

namespace backend\assets;

use yii\web\AssetBundle;

class MapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'http://maps.googleapis.com/maps/api/js',
        '/js/gapi.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
