<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'My Console Application',
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.extensions.yii-mail.*',
		//right
		'application.modules.*',
	//'application.modules.rights.components.*',
	),
	// application components
	'components' => array(
		// uncomment the following to use a MySQL database
//		'db' => array(
//			'connectionString' => 'mysql:host=localhost;dbname=daiichi',
//			'emulatePrepare' => true,
//			'username' => 'root',
//			'password' => 'root',
//			'charset' => 'utf8',
//		),
		'db' => array(
			//'connectionString' => 'mysql:host=122.155.168.114;dbname=dcorp',
			'connectionString' => 'mysql:host=122.155.168.114;dbname=daiichi',
			'emulatePrepare' => true,
			'username' => 'koolclass',
			'password' => 'koolclass229',
			//'username' => 'dcorp', 'password' => 'dcorpReport',
			'charset' => 'utf8',
		),
		'mail' => array(
			'class' => 'application.extensions.yii-mail.YiiMail',
			'transportType' => 'smtp', // change to 'php' when running in real domain.
			//'viewPath' => 'application.views.mail',
			'logging' => true,
			'dryRun' => false,
			'transportOptions' => array(
				'host' => 'smtp.gmail.com', //if not work, try smtp.googlemail.com
				'username' => 'kamon.p@daiigroup.com',
				'password' => '84888488ab',
				'port' => '465',
				'encryption' => 'ssl',
			),),
	),
	'params' => array(
		// this is used in contact page
		'sendEmail' => true,
	),
);