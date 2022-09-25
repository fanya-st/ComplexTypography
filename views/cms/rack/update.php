<?php

use yii\bootstrap5\Html;

$this->title = 'Обновить стеллаж: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Стеллажи', 'url' => ['rack-index']];
?>
<div class="rack-update">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
