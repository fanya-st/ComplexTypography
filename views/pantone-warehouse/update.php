<?php

use yii\bootstrap5\Html;


$this->title = 'Update Pantone Warehouse: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pantone Warehouses', 'url' => ['index']];
?>
<div class="pantone-warehouse-update">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
