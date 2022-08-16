<?php

use yii\bootstrap5\Html;


$this->title = 'Создание штанца';
$this->params['breadcrumbs'][] = ['label' => 'Штанцы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pants-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'picture_form' => $picture_form,
    ]) ?>

</div>
