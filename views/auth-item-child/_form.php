<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\AuthItem;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItemChild */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-child-form">

    <?php $form = ActiveForm::begin(); ?>

    
    
    <?= $form->field($model, 'parent')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(AuthItem::find()->all(), 'name', 'name'),
        'language' => 'es',
        'options' => ['placeholder' => 'Select a role ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    
    <?= $form->field($model, 'child')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(AuthItem::find()->all(), 'name', 'name'),
        'language' => 'es',
        'options' => ['placeholder' => 'Select a role ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
