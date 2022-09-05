<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file'=>[
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error','info','warning'],
                    'logVars' => ['_GET', '_POST'],
                ],
//                'db'=>[
//                    'class' => 'yii\log\DbTarget',
//                    'levels' => ['info'],
//                    'logVars' => ['_GET', '_POST'],
//                ],
            ],
        ],
        'db' => $db,
		'authManager' => [
//		    'class' => 'yii\rbac\PhpManager',
            'class' => 'yii\rbac\DbManager',
    ],
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
