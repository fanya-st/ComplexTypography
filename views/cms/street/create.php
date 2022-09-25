<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить улицу';
$this->params['breadcrumbs'][] = ['label' => 'Улицы', 'url' => ['street-index']];
?>

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

