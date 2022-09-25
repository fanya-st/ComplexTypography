<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить город';
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['town-index']];
?>

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>
