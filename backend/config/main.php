<?php
date_default_timezone_set('Asia/Tashkent');
$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-backend',
	'basePath' => dirname(__DIR__),
		'bootstrap' => ['log'],

		// set target language to be Russian
		'language' => 'cyrl',
    
		// set source language to be English
		'sourceLanguage' => 'ru',

	'controllerNamespace' => 'backend\controllers',
	'name' => 'control.standart.uz',
	//'language' => 'cyrl',
	'components' => [
		'request' => [
			'csrfParam' => '_csrf-backend',
			'baseUrl' => '/admin',
		],

		// ...
		'i18n' => [
			'translations' => [
				'app*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@backend/message',
					//'sourceLanguage' => 'en-US',
					'fileMap' => [
						'app' => 'app.php',
						'app/error' => 'error.php',
					],
				],
			],
		],

		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
		],
		'session' => [
			// this is the name of the session cookie used for login on the backend
			'name' => 'advanced-backend',
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
		
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
			],
		],
		
	],
	'as beforeRequest' => [
		'class' => 'yii\filters\AccessControl',
		'rules' => [
			 [
				'actions' => ['login'],
				'allow' => true,
			],
			[
				'allow' => true,
				'roles' => ['@'],
			],
		],
		'denyCallback' => function () {
			return Yii::$app->response->redirect(['site/login']);
		},
	],
	'params' => $params,
];
