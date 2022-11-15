<?php
date_default_timezone_set('Asia/Tashkent');
$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-api',
	'basePath' => dirname(__DIR__),
		'bootstrap' => ['log'],


	'controllerNamespace' => 'api\controllers',
	'name' => 'control.standart.uz',
	//'language' => 'cyrl',
	'components' => [
		'request' => [
			'csrfParam' => '_csrf-backend',
			'baseUrl' => '/api',
		],


		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'product'],
            ],
        ]
		
	],

	'params' => $params,
];
