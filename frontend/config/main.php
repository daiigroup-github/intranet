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
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=daiichi',
            'username' => 'intranet',
            'password' => '1Ntr@N3T938',
            'charset' => 'utf8',
        ],
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

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'EDk8lofh-rkx-40yLXXIPFr-M2DSaatw',
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
			'defaultRoute' => 'manage'
		]
	],
];
