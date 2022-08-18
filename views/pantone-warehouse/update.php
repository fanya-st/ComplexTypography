<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PantoneWarehouse */

$this->title = 'Update Pantone Warehouse: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pantone Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pantone-warehouse-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
