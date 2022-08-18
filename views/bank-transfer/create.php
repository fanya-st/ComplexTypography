<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить поступление';
$this->params['breadcrumbs'][] = ['label' => 'Банк', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-transfer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
