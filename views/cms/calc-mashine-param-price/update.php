<?php

use yii\helpers\Html;


$this->title = 'Update Calc Mashine Param Price: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Calc Mashine Param Prices', 'url' => ['calc-mashine-param-price-index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['calc-mashine-param-price-view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="calc-mashine-param-price-update">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
