<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= AlertBlock::widget([
    'type' => AlertBlock::TYPE_ALERT,
    'useSessionFlash' => true,
    'delay' => 20000,
]) ?>

<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
//        'caption'   => 'Articles',
//        'captionOptions'    => ['class' => 'text-center'],
//        'dataColumnClass'   => 'yii\grid\DataColumn',
        'dataProvider' => $dataProvider,
//        'emptyCell' => '-----',
        'emptyText'     => 'No existen datos',
        'emptyTextOptions'  => ['class' => 'alert alert-danger'],
        'filterErrorOptions'  => ['class' => 'alert alert-danger'],
        'filterModel' => $searchModel,
//        'headerRowOptions'  => ['class' => 'title'],
        /*
         * filterPosition values
         * -------------------------------------
         * yii\grid\GridView::FILTER_POS_HEADER
         * yii\grid\GridView::FILTER_POS_BODY
         * yii\grid\GridView::FILTER_POS_FOOTER
         * 'header'
         * 'body'
         * 'footer'
         */
//        'filterPosition'    => yii\grid\GridView::FILTER_POS_FOOTER,
//        'filterPosition'    => 'header',
        /**
         * layout values
         * ------------------------------------------------------------
         * {summary}: the summary section. See renderSummary().
         * {errors}: the filter model error summary. See renderErrors().
         * {items}: the list items. See renderItems().
         * {sorter}: the sorter. See renderSorter().
         * {pager}: the pager. See renderPager().
         */
        'layout' => "{pager}\n{summary}\n{items}\n{pager}",
//        'showHeader'    => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'title',
            [
                'attribute' => 'title',
                'format'    => 'raw',
                'value'     => function ($searchModel) {
                    return Html::a($searchModel->title, "@web/articulo/" . $searchModel->slug);
                },
            ],
            // 'slug',
            [
                'attribute' => 'type_id',
                'value'     => 'type.type',
                'format'    => 'raw',
                'filter'    => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'type_id',
                                'data' => \yii\helpers\ArrayHelper::map(\app\models\Type::find()->all(), 'id', 'type'),
                                'options' => ['placeholder' => 'Seleccione...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
            ],
            // 'download',
            [
                'attribute' => 'category_id',
                'value'     => 'category.category',
                'format'    => 'raw',
                'filter'    => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'category_id',
                                'data' => \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'category'),
                                'options' => ['placeholder' => 'Seleccione...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
            ],
            [
                'attribute' => 'course_id',
                'value'     => 'course.course',
                'format'    => 'raw',
                'filter'    => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'course_id',
                                'data' => \yii\helpers\ArrayHelper::map(\app\models\Course::find()->all(), 'id', 'course'),
                                'options' => ['placeholder' => 'Seleccione...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
            ],
            'visit_counter',
            'download_counter',
            // 'status',
            [
                'attribute' => 'created_by',
                'value'     => 'createdBy.name',
            ],
            [
                'attribute' => 'updated_by',
                'value'     => 'updatedBy.name',
            ],
            // 'detail:ntext',
            // 'video:ntext',
            // 'tags',
            // 'created_by',
            'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'rowOptions'    => function($model){
            if (!$model->status) {
                return ['class' => 'danger'];
            }
        },
        'showOnEmpty'   => false,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed']
    ]); ?>

</div>
