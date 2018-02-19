<?php

$params = require(__DIR__ . '/params.php');

$config = [
    //    'defaultRoute' => 'site/about',
//    'catchAll' => ['site/offline'],
    'aliases'           => [
        '@public'       => Yii::$app->homeUrl . 'web',
        '@bitbucket'    => 'https://bitbucket.org/blonder413/',
        '@delicious'    => 'https://delicious.com/blonder413',
        '@dribbble'     => 'https://dribbble.com/blonder413',
        '@facebook'     => 'https://www.facebook.com/blonder413',
        '@github'       => 'https://github.com/blonder413/',
        '@gitlab'       => 'https://gitlab.com/u/blonder413',
        '@google+'      => 'https://plus.google.com/u/0/+JonathanMoralesSalazar',
        '@lastfm'       => 'http://www.last.fm/es/user/blonder413',
        '@linkedin'     => 'https://www.linkedin.com/in/blonder413',
        '@twitter'      => 'https://twitter.com/blonder413',
        '@vimeo'        => 'https://vimeo.com/blonder413',
        '@youtube'      => 'https://www.youtube.com/channel/UCOBMvNSxe08V5E9qExfFt4Q',
    ],
    'id'                => 'blonder413',
    'language'          => 'es-CO',
    'name'              => 'Blonder413',
    'sourceLanguage'    => 'en-US',
    //    'layout'    => 'navidad/main',
    'timeZone'          => 'America/Bogota',
    'version'           => '0.1',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
		'view' => [
			 'theme' => [
				 'pathMap' => [
					'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-basic-app'
				 ],
			 ],
		],
		'authManager'       => [
            'class'         => 'yii\rbac\DbManager',
            'defaultRoles'  => ['guest'],
//            'itemTable'         => 'auth_item',         // tabla para guardar objetos de autorización
//            'itemChildTable'    => 'auth_item_child',   // tabla para almacenar jerarquía elemento autorización
//            'assignmentTable'   => 'auth_assignment',   // tabla para almacenar las asignaciones de elementos de autorización
//            'ruleTable'         => 'auth_rule',         // tabla para almacenar reglas
        ],
		'formatter' => [
            'class' => '\yii\i18n\Formatter',
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'currencyCode' => '$'
        ],
        'response' => [
            'formatters' => [
                'pdf' => [
                    'class' => 'robregonm\pdf\PdfResponseFormatter',
                    //'mode' => '', // Optional
                    'format' => 'letter',  // Optional but recommended. http://mpdf1.com/manual/index.php?tid=184
                    'defaultFontSize' => 0, // Optional
                    'defaultFont' => '', // Optional
                    'marginLeft' => 15, // Optional
                    'marginRight' => 15, // Optional
                    'marginTop' => 16, // Optional
                    'marginBottom' => 16, // Optional
                    'marginHeader' => 9, // Optional
                    'marginFooter' => 9, // Optional
                    //'orientation' => 'Landscape', // optional. This value will be ignored if format is a string value.
                    'options' => [
                        // mPDF Variables
                        // 'fontdata' => [
                            // ... some fonts. http://mpdf1.com/manual/index.php?tid=454
                        // ]
                    ]
                ],
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'irlTshu_Zl_91U9wDSvxkfgendDx4t4A',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /**
         * http://www.yiiframework.com/doc-2.0/guide-runtime-sessions-cookies.html
         * The default yii\web\Session class stores session data as files on the server.
         * Yii also provides the following session classes implementing different session storage:
         *  - yii\web\DbSession: stores session data in a database table.
         *  - yii\web\CacheSession: stores session data in a cache with the help of a configured cache component.
         *  - yii\redis\Session: stores session data using redis as the storage medium.
         *  - yii\mongodb\Session: stores session data in a MongoDB.
         */
        'session' => [
            'class' => 'yii\web\DbSession',
            // 'timeout' => 10, segundos de inactividad para expirar la sesión

            // Set the following if you want to use DB component other than
            // default 'db'.
            // 'db' => 'mydb',

            // To override default session table, set the following
            'sessionTable' => 'session',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,  // poner en falso para el cierre de sesión automático
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => require(__DIR__ . '/mailer.php'),
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
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'articulo/<slug>'           => 'site/article',
                'articulo/descarga/<slug>'  => 'site/download',
                'categoria/<slug>'          => 'site/category',
                'curso/index'               => 'site/all-courses',
                'curso/<slug>'              => 'site/course',
                'etiqueta/<tag>'            => 'site/tag',
                'acerca'                    => 'site/about',
                'home'                      => 'site/index',
                'contacto'                  => 'site/contact',
                'login'                     => 'site/login',
                "registro"                  => "site/signup",
                'pdf/<slug>'                => 'site/pdf',
                'portafolio'                => 'site/portfolio',
                'en-vivo'                   => 'site/streaming',
//                'usuario/new-password/<token:\w+>'      => 'site/new-password',
                'DELETE <controller:\w+>/<id:\d+>' => '<controller>/delete',
//                'pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'
                'sitemap.xml'               => 'sitemap/default/index',
                ['pattern' => '<id:rss>', 'route' => 'rss/default/index', 'suffix' => '.xml'],
//                'curso/<id:\d{4}>/items-list' => 'curse/items-list',    // parámetro numérico de 4 dígitos: id
//                'news/<category:\w+>/items-list' => 'test-rules/items-list',    // parámetro texto: category

//                'news/<year:\d{4}>/items-list' => 'news/items-list',
//                [
//                    'pattern' => 'news/<category:\w+>/items-list',
//                    'route' => 'news/items-list',
//                    'defaults' => ['category' => 'shopping']
//                ]
/*
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+\-\w+>/<id:\d+>' => '<controller>/view',
 */

            ],
        ],
    ],
    'modules' => require(__DIR__ . '/modules.php'),
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
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
