<?php

use yii\bootstrap5\Html;


$this->title = 'Добавить Субъект РФ';
$this->params['breadcrumbs'][] = ['label' => 'Субъекты РФ', 'url' => ['subject-index']];
?>
<div class="subject-create">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <?php echo  $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
