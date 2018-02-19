<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Recuperar contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php
        echo AlertBlock::widget([
            'type' => AlertBlock::TYPE_ALERT,
            'useSessionFlash' => true,
            'delay'     => 10000,
        ]);
        ?>
    </p>
    <p>Por favor digite su correo electrónico para recuperar su contraseña:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'email') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
