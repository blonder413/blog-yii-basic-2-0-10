<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">
    
    <?= date('Y-m-d H:i:s'); ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button(
            'Create course',
            [
                'class' => 'btn btn-primary',
                'id'    => 'modalButton',
                'value' => Url::to('create'),
            ]
        ) ?>
    </p>
    
    <?php
        Modal::begin([
            //'header' => '<h2>Create Course</h2>',
            'id'    => 'modal',
            'size'  => 'modal-lg',
        ]);
        
        echo "<div id='modalContent'></div>";
        
        Modal::end();
    ?>

    
   <?php Pjax::begin(['enablePushState' => false]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'course',
            'slug',
            'description:ntext',
            'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
