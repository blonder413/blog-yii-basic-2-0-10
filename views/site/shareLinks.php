<?php
use ijackua\sharelinks\ShareLinks;
use \yii\helpers\Html;
 
/**
 * @var yii\base\View $this
 */
 
?>

<div class="socialShareBlock">
    <?= Html::a(
//        '<i class="icon-facebook-squared"></i>',
        Html::img('@web/web/img/facebook.png', ['class'=>'img-responsive']),
        $this->context->shareUrl(ShareLinks::SOCIAL_FACEBOOK),
        [
            'title' => 'Compartir en Facebook'
        ]
    ) ?>
    
    <?= Html::a(
//        '<i class="icon-twitter-squared"></i>',
        Html::img('@web/web/img/twitter.png', ['class'=>'img-responsive']),
        $this->context->shareUrl(ShareLinks::SOCIAL_TWITTER),
        [
            'title' => 'Compartir en Twitter'
        ]
    ) ?>
    
    <?= Html::a(
//        '<i class="icon-linkedin-squared"></i>',
        Html::img('@web/web/img/linked-in.png', ['class'=>'img-responsive']),
        $this->context->shareUrl(ShareLinks::SOCIAL_LINKEDIN),
        [
            'title' => 'Compartir en LinkedIn'
        ]
    ) ?>
    
    <?= Html::a(
//        '<i class="icon-gplus-squared"></i>',
        Html::img('@web/web/img/google-plus.png', ['class'=>'img-responsive']),
        $this->context->shareUrl(ShareLinks::SOCIAL_GPLUS),
        [
            'title' => 'Compartir en Google Plus'
        ]
    ) ?>
    
    <?php //echo Html::a(
//        '<i class="icon-vkontakte"></i>',
//        $this->context->shareUrl(ShareLinks::SOCIAL_VKONTAKTE),
//        [
//            'title' => 'Share to Vkontakte'
//        ]
//    ) ?>
    
    <?php //echo Html::a(
//        '<i class="icon-tablet"></i>', 
//        $this->context->shareUrl(ShareLinks::SOCIAL_KINDLE),
//        [
//            'title' => 'Send to Kindle'
//        ]
//    ) ?>
</div>