<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Совместимость штанцев со станками', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mashine-pants-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
