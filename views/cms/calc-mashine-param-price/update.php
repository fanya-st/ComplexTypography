<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CalcMashineParamPrice */

$this->title = 'Update Calc Mashine Param Price: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Calc Mashine Param Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="calc-mashine-param-price-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
