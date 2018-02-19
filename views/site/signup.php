<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['options'=>[ 'id' => 'form-signup' , 'enctype'=>'multipart/form-data'] ]); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <!-- http://demos.krajee.com/widget-details/fileinput -->
                <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                    'options' => [
                        'accept' => 'image/*',
                    ],
                    'pluginOptions' => [
                        'showPreview' => true,
                        'showRemove' => false,
                        'showUpload' => false,
                    ],
                ]); ?>
                <?= $form->field($model, 'password_hash')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>