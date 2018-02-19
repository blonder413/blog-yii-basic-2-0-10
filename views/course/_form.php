<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

            <?= $form->field($model, 'course')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            
            <?= $form->field($model, 'file')->fileInput() ?>
        
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
