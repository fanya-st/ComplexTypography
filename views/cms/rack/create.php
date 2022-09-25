<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить стеллаж';
$this->params['breadcrumbs'][] = ['label' => 'Стеллажи', 'url' => ['rack-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rack-create">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
