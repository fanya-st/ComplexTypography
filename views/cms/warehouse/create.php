<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить склад';
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['warehouse-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
