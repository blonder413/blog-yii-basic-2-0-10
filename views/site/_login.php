<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <div class="col-md-3"></div>

    <div class="col-md-6 frame-login">

        <div class="text-center">
            <h1><?= Html::encode($this->title) ?></h1>

            <?= Html::img(
                    '@web/web/img/monker.png',
                    [
                        'alt'   => 'Página No Encontrada',
                        'class' => 'img-responsive',
                        'width' => '30%',
                    ]
            ) ?>
        </div>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            //'options' => ['class' => 'form-horizontal'],
            //'fieldConfig' => [
            //    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            //    'labelOptions' => ['class' => 'col-lg-1 control-label'],
            //],
        ]); ?>

        
            <?= $form->field($model, 'username') ?>
        
        

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe', [
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->checkbox() ?>

        <div class="row text-center">
            
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
            
        </div>
        
        <div class="row text-center">
            If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    
    <div class="col-md-3"></div>
    
    
</div>
