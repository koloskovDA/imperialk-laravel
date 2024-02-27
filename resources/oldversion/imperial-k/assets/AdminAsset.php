<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 19.02.15
 * Time: 20:44
 */

namespace app\assets;


use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'adminfiles/css/AdminLTE.min.css',
        'adminfiles/css/skins/_all-skins.min.css',
        'adminfiles/plugins/iCheck/flat/blue.css',
        'adminfiles/style.css',

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];


} 