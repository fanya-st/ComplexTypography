<?php

use yii\helpers\Html;


$this->title = 'Create Calc Common Params';
$this->params['breadcrumbs'][] = ['label' => 'Calc Common Params', 'url' => ['calc-common-params-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calc-common-params-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
