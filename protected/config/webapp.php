<?php
$params = require dirname(__FILE__) . '/params.php';
return CMap::mergeArray(
		require(dirname(__FILE__) . '/main.php'), array(
		'components'=>array(
			'clientScript'=>array(
				'defaultScriptFilePosition'=>CClientScript::POS_END,
				'coreScriptPosition'=>CClientScript::POS_END,
				'packages'=>array(
					'jquery'=>array(
						'baseUrl'=>$params['assets'] . '/jquery/',
						'js'=>array(
							'jquery-2.1.3.min.js',
							'jquery-ui.js',
							'jquery.cookie.js',
						),
					),
					'bootstrap'=>array(
						'baseUrl'=>$params['assets'] . '/',
						'css'=>array(
							'bootstrap/css/bootstrap.min.css',
							'fontawesome/css/font-awesome.min.css',
							'css/navbar-fixed-top.css',
							'css/style.css'
						),
						'js'=>array(
							'bootstrap/js/bootstrap.min.js',
							'js/accounting.min.js'
						),
						'depends'=>array(
							'jquery'
						),
					),
				),
			),
			'urlManager'=>array(
				'showScriptName'=>false,
				'rules'=>array(),
			),
		),
		'modules'=>array(
			// uncomment the following to enable the Gii tool
			'rawmat',
		),
		'params'=>array(
		// this is used in contact page
		),
		'theme'=>'bootstrap3',
		'defaultController'=>'home',
		'import'=>array(
			'application.models.master.*',
		),
		)
);
