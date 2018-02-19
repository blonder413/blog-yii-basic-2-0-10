<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\bootstrap\Modal;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Streaming */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="streaming-form">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
		</div>
		<div class="panel-body">
			<?php $form = ActiveForm::begin(); ?>

			<?= $form->field($model, 'title')->textInput(['autofocus' => true, 'maxlength' => true]) ?>
		
			<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
		
			<?= $form->field($model, 'embed')->textInput(['maxlength' => true]) ?>
			
			<?= $form->field($model, 'start')->widget(DateTimePicker::classname(), [
			'options' => ['placeholder' => 'Enter when start the streaming ...'],
			'pluginOptions' => [
				'autoclose' => true
			]
			]); ?>
			
			<?= $form->field($model, 'end')->widget(DateTimePicker::classname(), [
			'options' => ['placeholder' => 'Enter when end the streaming ...'],
			'pluginOptions' => [
				'autoclose' => true
			]
			]); ?>
		
			<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
		
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
