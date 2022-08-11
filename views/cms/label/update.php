<?php

use yii\helpers\Html;


$this->title = 'Update Label: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Label', 'url' => ['label-index']];
?>
<div class="label-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
