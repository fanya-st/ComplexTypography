<?php

use yii\bootstrap5\Html;


$this->title = 'Обновить транспорт: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Транспорт', 'url' => ['index']];
?>
<div class="transport-update">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
