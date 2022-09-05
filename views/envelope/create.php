<?php

use yii\bootstrap5\Html;


$this->title = 'Создать конверт';
$this->params['breadcrumbs'][] = ['label' => 'Конверты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="envelope-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>