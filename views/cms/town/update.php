<?php

use yii\bootstrap5\Html;


$this->title = 'Редиактировать город: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['town-index']];
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
