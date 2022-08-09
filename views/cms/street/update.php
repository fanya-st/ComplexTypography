<?php

use yii\helpers\Html;


$this->title = 'Update Street: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Streets', 'url' => ['street-index']];
?>
<div class="street-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
