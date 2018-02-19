<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Streaming */

$this->title = 'Update Streaming: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Streamings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="streaming-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
