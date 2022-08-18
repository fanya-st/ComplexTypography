<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить транспорт';
$this->params['breadcrumbs'][] = ['label' => 'Транспорт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
