<?php

$params = array_merge(
        require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app',
    'basePath' => dirname(__DIR__),
//    'controllerNamespace' => 'controllers',
    'bootstrap' => ['log'],
    'name' => 'SIMPADA',
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'components' => [
        'myHelper'=>[
            'class' => 'app\components\myHelper',
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'i18n' => [
            'translations' => [
                'kvgrid' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@vendor/kartik-v/yii2-grid/messages',
                ],
            ],
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
        'formatter' => [
            'class' => 'yii\i18n\formatter',
            'thousandSeparator' => '.',
            'decimalSeparator' => '-,',
            'currencyCode' => 'IDR',
//            'numberFormatterOptions' => [
//                'NumberFormatter::MIN_FRACTION_DIGITS' => 0,
//                'NumberFormatter::MAX_FRACTION_DIGITS' => 1,
//            ],
//             'numberFormatterSymbols' => [
//                'NumberFormatter::CURRENCY_SYMBOL' => 'Rp',
//            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
        ],
    ],
    'params' => $params,
];
