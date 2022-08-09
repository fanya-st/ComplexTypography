<?php

use yii\helpers\Html;


$this->title = 'Update Town: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Towns', 'url' => ['town-index']];
?>
<div class="town-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
