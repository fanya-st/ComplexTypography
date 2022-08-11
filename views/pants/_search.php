<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PantsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pants-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'shaft_id') ?>

    <?= $form->field($model, 'paper_width') ?>

    <?= $form->field($model, 'pants_kind_id') ?>

    <?php // echo $form->field($model, 'cuts') ?>

    <?php // echo $form->field($model, 'width_label') ?>

    <?php // echo $form->field($model, 'height_label') ?>

    <?php // echo $form->field($model, 'knife_kind_id') ?>

    <?php // echo $form->field($model, 'knife_width') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <?php // echo $form->field($model, 'radius') ?>

    <?php // echo $form->field($model, 'gap') ?>

    <?php // echo $form->field($model, 'material_group_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
