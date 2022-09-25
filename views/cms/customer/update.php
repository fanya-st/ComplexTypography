<?php

use yii\bootstrap5\Html;


$this->title = 'Редактировать заказчика: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказчики', 'url' => ['customer-index']];
?>

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>
