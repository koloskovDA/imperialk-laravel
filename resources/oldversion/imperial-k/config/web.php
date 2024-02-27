<?php

$params = require(__DIR__ . '/params.php');
//$db = (YII_ENV_DEV) ? require(__DIR__ .'/db.php') : require(__DIR__ .'db.php');

$config = [
    'id' => 'Imperial-K',
    'name'=>'Imperial-K',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'authManager'=>[
            'class'=>'yii\rbac\PhpManager',
            'defaultRoles'=>['user','moder','admin'],
            'itemFile'=>'@app/components/rbac/items.php',
            'assignmentFile'=>'@app/components/rbac/assignments.php',
            'ruleFile'=>'@app/components/rbac/rules.php'
        ],

        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => array(
                        '//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js',
                    ),

                ],

            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>[
                'contact'=>'site/contact',
                '<_c>/<id:\d+>'=>'<_c>/view',
                '<_m>/<_c>/<id:\d+>' =>'<_m>/<_c>/view',
            ]
        ],

        'formatter'=>[
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
        ],

        'request' => [

            'cookieValidationKey' => 'RYU8Zk8a6qn5N1bZvUaX3TM6LnRBnHpL',
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'auctions' => [
            'class' => 'app\modules\auctions\Module',
        ],

        'news' => [
            'class' => 'app\modules\news\Module',
        ],

        'pages' => [
            'class' => 'app\modules\pages\Module',
        ],

        'filials' => [
            'class' => 'app\modules\filials\Module',
        ],

        'questions' => [
            'class' => 'app\modules\questions\Module',
        ],

        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],

        'shop' => [
            'class' => 'app\modules\shop\Module',
        ],

    ],

    'params' => $params,
];


    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';


return $config;
