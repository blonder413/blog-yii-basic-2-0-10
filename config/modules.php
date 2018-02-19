<?php
return [
        'rss' => [
            'class' => 'himiklab\rss\Rss',
            'feeds' => [
                'rss' => [
                    'title' => 'Blonder413 Feeds',
                    'description' => 'Programación dinámica',
                    'link' => 'http://www.blonder413.com/',
                    'language' => 'es-CO'
                ],
            ]
        ],
        'sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',
            'models' => [
                // your models
                'app\models\Article',
                // or configuration for creating a behavior
    //            [
    //                'class' => 'app\modules\news\models\News',
    //                'behaviors' => [
    //                    'sitemap' => [
    //                        'class' => SitemapBehavior::className(),
    //                        'scope' => function ($model) {
    //                            /** @var \yii\db\ActiveQuery $model */
    //                            $model->select(['url', 'lastmod']);
    //                            $model->andWhere(['is_deleted' => 0]);
    //                        },
    //                        'dataClosure' => function ($model) {
    //                            /** @var self $model */
    //                            return [
    //                                'loc' => Url::to($model->url, true),
    //                                'lastmod' => strtotime($model->lastmod),
    //                                'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
    //                                'priority' => 0.8
    //                            ];
    //                        }
    //                    ],
    //                ],
    //            ],
            ],
    //        'urls'=> [
    //            // your additional urls
    //            [
    //                'loc' => '/news/index',
    //                'changefreq' => \himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
    //                'priority' => 0.8,
    //                'news' => [
    //                    'publication'   => [
    //                        'name'          => 'Example Blog',
    //                        'language'      => 'en',
    //                    ],
    //                    'access'            => 'Subscription',
    //                    'genres'            => 'Blog, UserGenerated',
    //                    'publication_date'  => 'YYYY-MM-DDThh:mm:ssTZD',
    //                    'title'             => 'Example Title',
    //                    'keywords'          => 'example, keywords, comma-separated',
    //                    'stock_tickers'     => 'NASDAQ:A, NASDAQ:B',
    //                ],
    //                'images' => [
    //                    [
    //                        'loc'           => 'http://example.com/image.jpg',
    //                        'caption'       => 'This is an example of a caption of an image',
    //                        'geo_location'  => 'City, State',
    //                        'title'         => 'Example image',
    //                        'license'       => 'http://example.com/license',
    //                    ],
    //                ],
    //            ],
    //        ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
    ];