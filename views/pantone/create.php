<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить PANTONE';
$this->params['breadcrumbs'][] = ['label' => 'Пантоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pantone-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
