<?php

use yii\helpers\Html;


$this->title = 'Добавление втулки';
$this->params['breadcrumbs'][] = ['label' => 'Втулки', 'url' => ['sleeve-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sleeve-create">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
