<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="<?= Yii::$app->homeUrl ?>web/img/favicon.png" rel="icon" type="image/vnd.microsoft.icon"/>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Blonder413',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Inicio', 'url' => Yii::$app->homeUrl],
                    ['label' => 'Acerca', 'url' => ['/site/about']],
                    ['label' => 'En Vivo', 'url' => ['/site/streaming']],
                    ['label' => 'Contacto', 'url' => ['/site/contact']],
                    // ['label' => 'Signup', 'url' => ['/site/signup']],
                    [
                        'label' => 'Cursos',
                        'items' => [
                            ['label'     => 'MySQL', 'url' => ['curso/mysql']],
                            ['label'     => 'PHP 5', 'url' => ['curso/php-5']],
                            ['label'     => 'YiiFramework 2', 'url' => ['curso/yiiframework-2']],
                            ['label'     => 'Todos los cursos', 'url' => ['curso/index']],
                        ]
                    ],
                    Yii::$app->user->isGuest ?
                        '' :
                        [
                            'label' => 'Admin',
                            'items' => [
                                ['label' => 'Article', 'url' => ['/article/index']],
                                ['label' => 'AthItem', 'url' => ['/auth-item/index']],
                                ['label' => 'AthItemChild', 'url' => ['/auth-item-child/index']],
                                ['label' => 'Category', 'url' => ['/category/index']],
                                ['label' => 'Comment', 'url' => ['/comment/index']],
                                ['label' => 'Course', 'url' => ['/course/index']],
                                ['label' => 'Streaming', 'url' => ['/streaming/index']],
                                [
                                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                    'url' => ['/site/logout'],
                                    'linkOptions' => ['data-method' => 'post']
                                ],
                            ]
                        ],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="text-center">
            <hr>
            <a rel="license" href="http://creativecommons.org/licenses/by-sa/2.5/co/">
                <img alt="Licencia Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/2.5/co/88x31.png" />
            </a>
            <br>

            <!--
            <a href="http://www.w3.org/html/logo/">
                    <img src="http://www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png" width="165" height="64" alt="HTML5 Powered with CSS3 / Styling, and Semantics" title="HTML5 Powered with CSS3 / Styling, and Semantics">
            </a>
            <br>
            -->

            <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title" class="negrita">Blonder413 - Aprendizaje dinámico</span> por <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.blonder413.com" property="cc:attributionName" rel="cc:attributionURL">Jonathan Morales Salazar</a> <br>se encuentra bajo una Licencia <a rel="license" href="http://creativecommons.org/licenses/by-sa/2.5/co/">Creative Commons Atribución-CompartirIgual 2.5 Colombia</a>.
            <br>2011 - <?php echo date("Y"); ?>
        </footer>
    
    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = '1388fee2a7b9efb38a5ff5a6421028fdaa9c370f';
    window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='//www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);
    </script>
    <!-- End Smartsupp Live Chat script -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
