<?php

$params = require __DIR__ . '/params.php';
//$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'elbit-campaign',
    'name' => 'כיוון - חיפוש משרה',
    'language' => 'he-IL',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@web'   => '@app/public_html'
    ],
    'components' => [
        'socialShareBgCircle' => [
            'class' => \ymaker\social\share\configurators\Configurator::class,
            'socialNetworks' => [
                'facebook' => [
                    'class' => \ymaker\social\share\drivers\Facebook::class,
                    'label' => \yii\helpers\Html::tag('i', '', ['class' => 'si si-facebook']),
                    'options' => ['class' => 'fb bg-bordered-circle'],
                ],
                'linkedIn' => [
                    'class' => \ymaker\social\share\drivers\LinkedIn::class,
                    'label' => \yii\helpers\Html::tag('i', '', ['class' => 'si si-linkedin']),
                    'options' => ['class' => 'in bg-bordered-circle'],
                ],
                'whatsapp' => [
                    'class' => app\helpers\SocialSahreWhatsapp::class,
                    'label' => \yii\helpers\Html::tag('i', '', ['class' => 'si si-whatsapp']), 
                    'options' => ['class' => 'wa bg-bordered-circle'],
                ]
            ],
        ],
        'socialShare' => [
            'class' => \ymaker\social\share\configurators\Configurator::class,
            'socialNetworks' => [
                'facebook' => [
                    'class' => \ymaker\social\share\drivers\Facebook::class,
                    'label' => \yii\helpers\Html::tag('i', '', ['class' => 'si si-facebook']),
                    'options' => ['class' => 'fb'],
                ],
                'linkedIn' => [
                    'class' => \ymaker\social\share\drivers\LinkedIn::class,
                    'label' => \yii\helpers\Html::tag('i', '', ['class' => 'si si-linkedin']),
                    'options' => ['class' => 'in'],
                ],
                'whatsapp' => [
                    'class' => app\helpers\SocialSahreWhatsapp::class,
                    'label' => \yii\helpers\Html::tag('i', '', ['class' => 'si si-whatsapp']), 
                    'options' => ['class' => 'wa'],
                ]
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'OfPVPMCZnudUwu_7Qk6oNU4v8N0ciLsw',
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
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['meni'],
                    'exportInterval' => 1,
                    'logFile' => '@app/runtime/logs/meni.log',
                ],
            ],
        ],
        //        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<action:\w+>' => 'site/<action>',
            ],
        ],
    ],
    'params' => $params,
    'defaultRoute' => 'site/index',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];
}

return $config;
