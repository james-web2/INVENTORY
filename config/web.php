<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'inventory-system',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'en-US',
    'defaultRoute' => 'site/dashboard', // Default route to the dashboard
    'name' => 'SmartStock Inventory System',
    'aliases' => [
        '@webroot' => dirname(__DIR__) . '/web',
        '@web' => '/inventory-system/web',
        '@images' => dirname(__DIR__) . '/web/images',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'YOUR_SECRET_KEY_HERE', // CHANGE THIS TO A UNIQUE RANDOM STRING
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'savePath' => '@runtime/sessions',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['auth/login'],
            'returnUrl' => ['site/dashboard'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        // ✅ Symfony Mailer (useFileTransport = false to send real emails)
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => true,
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

        
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],

        // ✅ External CDN assets for Bootstrap 5 & jQuery
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap5\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => [
                        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
                    ],
                ],
                'yii\bootstrap5\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'js' => [
                        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
                    ],
                ],
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => [
                        'https://code.jquery.com/jquery-3.6.0.min.js',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];

// ✅ Enable debug and gii modules in development
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
