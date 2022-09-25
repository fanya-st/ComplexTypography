<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить расход';
$this->params['breadcrumbs'][] = ['label' => 'Затраты предприятия', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enterprise-cost-create">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
