<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить улицу';
$this->params['breadcrumbs'][] = ['label' => 'Улицы', 'url' => ['street-index']];
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

