<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить командировку';
$this->params['breadcrumbs'][] = ['label' => 'Командировки сотрудников', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-trip-employee-create">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
