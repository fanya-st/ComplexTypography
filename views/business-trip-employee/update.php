<?php

use yii\bootstrap5\Html;



$this->title = 'Обновить командировку: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Командировки сотрудников', 'url' => ['index']];
?>
<div class="business-trip-employee-update">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
