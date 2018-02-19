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
<html lang="es">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    
    <meta name='author' content='Jonathan Morales Salazar'>
    <meta name='copyright' content='www.blonder413.com'>
    <meta name='designer' content='www.blonder413.com'>
    <meta name='publisher' content='www.blonder413.com'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php if (isset($this->params['description'])): ?>
    <meta name="description" content="<?= $this->params['description']; ?>">
    <?php endif; ?>
        
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="<?= Yii::$app->homeUrl ?>web/css/magazine/style.css" rel="stylesheet" type="text/css">
    <link href="<?= Yii::$app->homeUrl ?>web/img/favicon.png" rel="icon" type="image/vnd.microsoft.icon"/>
    <!--<link rel="image_src" href="<?php //echo Yii::$app->homeUrl . 'web/img/' . $this->image_src . '.png' ?>">-->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="alternate" type="application/rss+xml" title="RSS feed" href="/rss.xml" />
    
    <!-- Registro en Google -->
    <!-- Put the following javascript before the closing </head> tag. -->
    <script>
        (function() {
            var cx = '009014689535229426168:oaz4ieig01w';
            var gcse = document.createElement('script');
            gcse.type = 'text/javascript';
            gcse.async = true;
            gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                    '//www.google.es/cse/cse.js?cx=' + cx;
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(gcse, s);
        })();
    </script>
    <!-- /Registro en Google -->
    
</head>
    <body>
    <?php $this->beginBody() ?>
        <div class="row">
            <section class="posts col-md-9">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </section>
        </div>
    <?php $this->endBody() ?>
    
        <!-- Diseño del reproductor de videos -->
        <script data-cfasync="false">
          (function(r,e,E,m,b){E[r]=E[r]||{};E[r][b]=E[r][b]||function(){
          (E[r].q=E[r].q||[]).push(arguments)};b=m.getElementsByTagName(e)[0];m=m.createElement(e);
          m.async=1;m.src=("file:"==location.protocol?"https:":"")+"//s.reembed.com/G-1BYYQn.js";
          b.parentNode.insertBefore(m,b)})("reEmbed","script",window,document,"api");
        </script>
        <!-- /Diseño del reproductor de videos -->
        
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
    
    </body>
</html>
<?php $this->endPage() ?>