<?php

use yii\helpers\Html;


$this->title = 'Create Town';
$this->params['breadcrumbs'][] = ['label' => 'Towns', 'url' => ['town-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="town-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
