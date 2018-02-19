<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= AlertBlock::widget([
    'type' => AlertBlock::TYPE_ALERT,
    'useSessionFlash' => true,
    'delay'     => 10000,
]); ?>

<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('List', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'number',
            //'title',
            [
                'attribute' => 'title',
                'format'    => 'raw',
                'value'     => Html::a($model->title, ['@web/articulo/' . $model->slug]),
            ],
            'slug',
            'detail:ntext',
            'video',
            //'type_id',
            [
                'label' => 'Type',
                'value' => $model->type->type,
            ],
            'download',
            //'category_id',
            [
                'label' => 'Category',
                'value' => $model->category->category,
            ],
            'tags',
            'status',
            'course_id',
            //'created_by',
            [
                'label' => 'Created_by',
                'value' => $model->createdBy->name,
            ],
            'created_at',
//            'created_at:datetime',
//            'updated_by',
            [
                'label' => 'Updated_by',
                'value' => $model->updatedBy->name,
            ],
            'updated_at',
//            'updated_at:datetime',
        ],
    ]) ?>

</div>
