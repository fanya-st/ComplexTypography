<?php

use yii\bootstrap5\Html;


$this->title = 'Обновить поступление: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Банк', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
?>
<div class="bank-transfer-update">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
