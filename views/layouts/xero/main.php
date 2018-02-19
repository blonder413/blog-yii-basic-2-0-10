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

<?php

$script = <<< JS
$(document).ready(function() {
    $("a.mobile").click(function(){
        $(".sidebar").slideToggle('fast');
    });
    
    window.onresize = function(event) {
        if ($(window).width() > 480) {
            $(".sidebar").show();
        }
    };
});
JS;
$this->registerJs($script);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
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
        <link href="<?= Yii::$app->homeUrl ?>web/img/favicon.png" rel="icon" type="image/vnd.microsoft.icon"/>
        
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="alternate" type="application/rss+xml" title="RSS feed" href="/rss.xml" />
        <meta name="viewport" content="width=device-width, initial-scale: 1.0">
        
        <?php $this->head() ?>
        
        <link href="<?php echo Yii::$app->homeUrl; ?>/web/css/xero/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php $this->beginBody() ?>
        
        <div id="header">
            <div class="logo">
                <a href="#">Blonder413</a>
            </div>
        </div>
        
        <div class="mobile">
            <a href="#" class="mobile">Menú</a>
        </div>
        
        
            <div class="sidebar">
                <ul id="nav">
                    <li><a href="<?= Yii::$app->homeUrl . 'article' ?>">Articles</a></li>
                    <li><a href="<?= Yii::$app->homeUrl . 'category' ?>">Categories</a></li>
					<li><a href="<?= Yii::$app->homeUrl . 'comment' ?>">Comments</a></li>
                    <li><a href="<?= Yii::$app->homeUrl . 'course' ?>">Courses</a></li>
					<li><a href="<?= Yii::$app->homeUrl . 'streaming' ?>">Streamings</a></li>
					<li><a href="<?= Yii::$app->homeUrl . 'type' ?>">Types</a></li>
                    <li><a href="<?= Yii::$app->homeUrl . 'user' ?>">Users</a></li>
                </ul>
            </div>
            <div class="content">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>
        
    </body>
    <?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>