<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/style.css',
        'plugins/select2/select2.min.css',
        'css/fontawesome-pro-5.4.1/css/all.css',
    ];
    public $js = [
        'plugins/select2/select2.full.min.js',
        'plugins/input-mask/jquery.input.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
