<?php

use yii\bootstrap5\Html;


$this->title = 'Редактировать регион: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Регионы', 'url' => ['region-index']];
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
