<?php

use yii\helpers\Html;


$this->title = 'Update Subject: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['subject-index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subject-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
