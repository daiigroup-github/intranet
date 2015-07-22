<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap css files.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PixeladminAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/pixel-admin';
    public $css = [
        'bootstrap/css/bootstrap.min.css',
        'css/pixel-admin.min.css',
        'css/widgets.min.css',
        'css/pages.min.css',
        'css/rtl.min.css',
        'css/themes.min.css',
        'font-awesome/css/font-awesome.min.css',
//        'css/intranet.css'
    ];
    public $js = [
        'bootstrap/js/bootstrap.min.js',
        'js/pixel-admin.min.js',
//        'js/fancybox.js'
    ];
}
