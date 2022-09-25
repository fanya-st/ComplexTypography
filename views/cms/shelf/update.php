<?php

use yii\bootstrap5\Html;


$this->title = 'Обновить полку: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Полки', 'url' => ['shelf-index']];
?>
<div class="shelf-update">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
