<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить полку';
$this->params['breadcrumbs'][] = ['label' => 'Полки', 'url' => ['shelf-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shelf-create">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
