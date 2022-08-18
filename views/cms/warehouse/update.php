<?php

use yii\bootstrap5\Html;


$this->title = 'Обновить склад: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['warehouse-index']];
?>
<div class="warehouse-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
