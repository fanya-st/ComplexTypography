<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить ЛКМ';
$this->params['breadcrumbs'][] = ['label' => 'Склад ЛКМ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pantone-warehouse-create">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
