<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= AlertBlock::widget([
    'type' => AlertBlock::TYPE_ALERT,
    'useSessionFlash' => true,
    'delay' => 20000,
]) ?>

<div class="category-index">

    <?php
    $flashMessages = Yii::$app->session->getAllFlashes();
    if ($flashMessages) {
        foreach($flashMessages as $key => $message) {
            echo "<div class='alert alert-" . $key . " alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    $message
                </div>";   
        }
    }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'category',
            'slug',
            'image',
            'description',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
