<?php
$params = require dirname(__FILE__) . '/params.php';
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'sourceLanguage'=>'th',
	'basePath'=>dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name'=>'Daiichi Intranet',
	'defaultController'=>'site/login',
	// preloading 'log' component
	'preload'=>array(
		'log'),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.yii-mail.*',
		//right
		'application.modules.rights.*',
		'application.modules.rights.components.*',
		'application.controllers.job.*',
		'application.extensions.GalleryManager.*',
		'application.extensions.GalleryManager.models.*',
		'application.helpers.*',
	),
	'modules'=>array(
// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false, //'12345',
// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>false, //array('192.168.56.1','::1'),
		),
		'mobile',
		'rights'=>array(
			'install'=>false, // Whether to install rights.
//'superuserName'=>'kpu',
		), // Enables the installer. ), ),
		'fitfast'
	),
	// application components
	'components'=>array(
		'user'=>array(
// enable cookie-based authentication
			'class'=>'RWebUser',
			'allowAutoLogin'=>true,
			'loginUrl'=>array(
				'site/login'),
		),
		'authManager'=>array(
			'class'=>'RDbAuthManager',
			'connectionID'=>'db',
			'defaultRoles'=>array(
				'Guest')
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'fitfast/<controller:\w+>/<action:\w+>/<id1:\w+>/<id2:\w+>'=>'fitfast/<controller>/<action>',
				'fitfast/<controller:\w+>/<action:\w+>/<id:\d+>'=>'fitfast/<controller>/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>/<codePrefix:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<id1:\d+>/<id2:\d+>'=>'<controller>/<action>',
			//'<controller:\w+>/<action:\w+>/<id:\d{3}>/<id2>'=>'<controller>/<action>',
			),
		),
		/* 'db'=>array(
		  'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		  ), */
// uncomment the following to use a MySQL database
		'db'=>$params['db'],
		'mail'=>array(
			'class'=>'application.extensions.yii-mail.YiiMail',
			'transportType'=>'smtp', // change to 'php' when running in real domain.
//'viewPath' => 'application.views.mail',
			'logging'=>true,
			'dryRun'=>false,
			'transportOptions'=>array(
				'host'=>'smtp.gmail.com', //if not work, try smtp.googlemail.com
				'username'=>'kamon.p@dcorp.co.th',
				'password'=>'84888488ab',
				'port'=>'465',
				'encryption'=>'ssl',
			),),
		'errorHandler'=>array(
// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					//'levels'=>'error, warning, trace',
					'levels'=>'error, warning',
				),
			// uncomment the following to show log messages on web pages
			/*
			  /* array(
			  'class'=>'CWebLogRoute',
			  ), */
			),
		),
		/* 'file'=>array(
		  'class'=>'application.extensions.file.CFile',
		  ), */
		/* 'CALENDAR'=>array(
		  'class' => 'application.extensions.googlecalendar.googlecalendar',
		  ), */
		'image'=>array(
			'class'=>'application.extensions.image.CImageComponent',
			// GD or ImageMagick
			'driver'=>'GD',
			// ImageMagick setup path
			'params'=>array(
				'directory'=>'/opt/local/bin'),
		),
	),
	// application-level parameters that can be accessed
// using Yii::app()->params['paramName']
	'params'=>array(
// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'sendEmail'=>FALSE,
	),
);
