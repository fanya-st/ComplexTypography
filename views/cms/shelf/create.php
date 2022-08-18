<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить полку';
$this->params['breadcrumbs'][] = ['label' => 'Полки', 'url' => ['shelf-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shelf-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
