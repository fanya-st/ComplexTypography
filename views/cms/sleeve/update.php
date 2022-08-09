<?php

use yii\helpers\Html;


$this->title = 'Редактировать втулку: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Втулки', 'url' => ['sleeve-index']];
?>
<div class="sleeve-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
