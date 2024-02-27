<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/shop.style.css',
       // 'css/perfect-scrollbar.css',
        '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
     //   'fancybox/source/jquery.fancybox.css',
    ];
    public $js = [
        'fancybox/lib/jquery.mousewheel-3.0.6.pack.js',
        'fancybox/source/jquery.fancybox.pack.js?v=2.1.5',
        'js/back-to-top.js',
        'js/jquery.mousewheel.js',
        'js/shop.app.js',
        'js/app.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
