<?php

use yii\bootstrap5\Html;


$this->title = 'Редактировать Субъект РФ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Субъекты РФ', 'url' => ['subject-index']];
?>

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

