<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StreamingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Streamings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="streaming-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Streaming', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            //'embed',
            [
                'attribute' => 'start',
                'filter'    => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'start',
                    //'template' => '{addon}{input}',
                        'clientOptions' => [
                            'autoclose' => true,
                            //'format' => 'dd-M-yyyy',
                            'format' => 'yyyy-mm-dd',
                        ]
                ]),
                'format'    => 'raw',
                'value'     => 'start',
            ],
            [
                'attribute' => 'created_by',
                'value'     => 'createdBy.name',
            ],
            
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
