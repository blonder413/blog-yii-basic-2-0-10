<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Streaming */

$this->title = 'Create Streaming';
$this->params['breadcrumbs'][] = ['label' => 'Streamings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="streaming-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
