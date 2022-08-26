<?php

use yii\bootstrap5\Html;


$this->title = 'Обновить штанец: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Штанцы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Штанец №'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="pants-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'picture_form'=>$picture_form,
    ]) ?>

</div>
