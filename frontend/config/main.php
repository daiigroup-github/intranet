<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'Daii Group Intranet',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['signin'],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@app/themes/pixel-admin'],
                'baseUrl' => '@web'
            ]
        ],
        'assetManager' => [
            'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    'js'=>[]
//                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => []
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                    'js' => []
                ],

            ],
        ],
    ],
    'params' => $params,
    'defaultRoute' => 'home/index',

    'modules' => [
        'fitandfast' => [
            'class' => 'frontend\modules\fitandfast\Fitandfast',
        ],
        'document' => [
            'class' => 'frontend\modules\document\Document',
        ],
        'mobile' => [
            'class' => 'frontend\modules\mobile\Mobile',
        ],
        'employee' => [
            'class' => 'frontend\modules\employee\Employee',
        ]
    ],
];
