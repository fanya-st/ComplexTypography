<?php

use yii\helpers\Html;


$this->title = 'Update Region: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['region-index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="region-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
