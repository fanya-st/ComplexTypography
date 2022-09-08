<?php

use yii\bootstrap5\Html;


$this->title = 'Редактировать заказчика: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказчики', 'url' => ['customer-index']];
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
