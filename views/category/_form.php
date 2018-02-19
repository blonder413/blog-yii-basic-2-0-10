<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

            <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>
            
            <?php // echo $form->field($model, 'file')->fileInput() ?>
            
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
        
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
