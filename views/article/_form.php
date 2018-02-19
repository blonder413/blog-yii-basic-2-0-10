<?php

use app\models\Category;
use app\models\Type;
use app\models\Course;

use dosamigos\ckeditor\CKEditor;
//use dosamigos\tinymce\TinyMce;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>
    
        <?php echo $form->field($model, 'detail')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'complete',
        ]); ?>
    
        <?php // echo $form->field($model, 'detail')->widget(TinyMce::className(), [
    //        'options' => ['rows' => 6],
    //        'language' => 'es',
    //        'clientOptions' => [
    //            'plugins' => [
    //                "advlist autolink lists link charmap print preview anchor",
    //                "searchreplace visualblocks code fullscreen",
    //                "insertdatetime media table contextmenu paste"
    //            ],
    //            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    //        ]
    //    ]);?>
    
        <?= $form->field($model, 'abstract')->textArea(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'video')->textarea(['rows' => 6]) ?>
    
        <?= $form->field($model, 'type_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Type::find()->all(), 'id', 'type'),
            'language' => 'es',
            'options' => ['placeholder' => 'Select a type ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    
        <?= $form->field($model, 'download')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Category::find()->all(), 'id', 'category'),
            'language' => 'es',
            'options' => ['placeholder' => 'Select a category ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    
        <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'course_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Course::find()->all(), 'id', 'course'),
            'language' => 'es',
            'options' => ['placeholder' => 'Select a course ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>

</div>
