<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db-dev.php';

$config = [
    'id' => 'basic',
    'name' => 'Комплекс Типография',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Europe/Moscow',
    'language' =>'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'container' => [
        'definitions' => [
            \yii\widgets\LinkPager::class => \yii\bootstrap5\LinkPager::class,
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '_gaylA8L4sBKm1FAz1aL7JXZyF22RRyE',
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'session' => [
////            'class' => 'yii\web\DbSession',
//            'class' => 'yii\web\CacheSession',
//        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
            'viewPath' => '@app/mail',
            'transport' => [
                'dsn' => 'smtp://tech@alprint.org:pass@smtp.yandex.com:465',
            ],
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
//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'rules' => [
//                'orders' => 'order/list',
//                'order/<id:\d+>' => 'order/view',
//            ],
//        ],

    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
    ];
}

return $config;
