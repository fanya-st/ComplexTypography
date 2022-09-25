<?php

use yii\bootstrap5\Html;


$this->title = 'Обновить PANTONE: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пантоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="pantone-update">

    <h1><?php echo  Html::encode($this->title) ?></h1>
    <?php echo  $this->render('_form', [
        'model' => $model,
        'mixed_pantones' => $mixed_pantones,
    ]) ?>

</div>
