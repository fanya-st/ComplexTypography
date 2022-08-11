<?php

use yii\helpers\Html;


$this->title = 'Update Calc Common Params: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Calc Common Params', 'url' => ['calc-common-params-index']];
?>
<div class="calc-common-params-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
