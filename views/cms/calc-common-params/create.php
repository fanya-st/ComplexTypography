<?php

use yii\bootstrap5\Html;


$this->title = 'Создать общий параметр для калькулятора';
$this->params['breadcrumbs'][] = ['label' => 'Общие параметры калькулятора', 'url' => ['calc-common-params-index']];
?>

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>
