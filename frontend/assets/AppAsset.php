<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

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
//        'themes/pixel-admin/bootstrap/css/bootstrap.min.css',
//        'css/site.css',
//        'themes/pixel-admin/css/pixel-admin.min.css',
//        'themes/pixel-admin/css/widgets.min.css',
//        'themes/pixel-admin/css/pages.min.css',
//        'themes/pixel-admin/css/rtl.min.css',
//        'themes/pixel-admin/css/themes.min.css',
//        'themes/pixel-admin/font-awesome/css/font-awesome.min.css',
    ];
    public $js = [
//        'themes/pixel-admin/bootstrap/js/bootstrap.min.js',
//        'themes/pixel-admin/js/pixel-admin.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'frontend\assets\PixeladminAsset',
    ];
}
