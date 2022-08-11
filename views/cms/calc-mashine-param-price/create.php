<?php

use yii\bootstrap5\Html;



$this->title = 'Create Calc Mashine Param Price';
$this->params['breadcrumbs'][] = ['label' => 'Calc Mashine Param Prices', 'url' => ['calc-mashine-param-price-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calc-mashine-param-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
