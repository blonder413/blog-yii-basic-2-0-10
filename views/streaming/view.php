<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Streaming */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Streamings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="streaming-view">
    
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

    <p>
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
            'title',
            'description:ntext',
            'embed',
            'start',
            'end',
            'createdBy.name',
            'created_at',
            'updatedBy.name',
            'updated_at',
        ],
    ]) ?>

</div>
