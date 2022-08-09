<?php

use yii\helpers\Html;


$this->title = 'Create Subject';
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['subject-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
