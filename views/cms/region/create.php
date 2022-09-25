<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить регион';
$this->params['breadcrumbs'][] = ['label' => 'Регионы', 'url' => ['region-index']];
?>

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>
