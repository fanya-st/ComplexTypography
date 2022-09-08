<?php

use yii\bootstrap5\Html;


$this->title = 'Обновить общий параметр для калькулятора: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Общие параметры калькулятора', 'url' => ['calc-common-params-index']];
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
