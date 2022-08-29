<?php

use yii\bootstrap5\Html;


$this->title = 'Привязать сотрудника к группе';
$this->params['breadcrumbs'][] = ['label' => 'Привязки', 'url' => ['auth-assign-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
