<?php

use yii\bootstrap5\Html;


$this->title = 'Обновить этикетку: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Этикетки', 'url' => ['label-index']];
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
