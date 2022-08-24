<?php

use yii\bootstrap5\Html;


$this->title = 'Обновить конверт: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Конверты', 'url' => ['index']];
?>
<div class="envelope-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
