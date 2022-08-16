<?php

use yii\bootstrap5\Html;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
use yii\widgets\Pjax;
use app\models\MixedPantone;


$this->title = 'Обновить PANTONE: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пантоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="pantone-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'mixed_pantones' => $mixed_pantones,
    ]) ?>

</div>
