<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class AppAssetIE9 extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $cssOptions = ['condition' => 'lte IE9'];
    public $css = [
        'http://html5shim.googlecode.com/svn/trunk/html5.js',
        'source/js/respond.min.js'
    ];
    public $js = [
    ];
    public $depends = [
    ];
}
