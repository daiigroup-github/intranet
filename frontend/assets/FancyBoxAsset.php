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
class FancyBoxAsset extends AssetBundle
{
    public $sourcePath = '@frontend/web/js';
    public $css = [
        'fancybox/jquery.fancybox.css?v=2.1.5',
        'fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5',
        'fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7'
    ];
    public $js = [
        'fancybox/jquery.fancybox.pack.js',
        'fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5',
        'fancybox/helpers/jquery.fancybox-media.js?v=1.0.6',
        'fancybox.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
}
