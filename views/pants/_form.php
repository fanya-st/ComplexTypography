<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

?>

<div class="pants-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shaft_id')->textInput() ?>

    <?= $form->field($model, 'paper_width')->textInput() ?>

    <?= $form->field($model, 'pants_kind_id')->textInput() ?>

    <?= $form->field($model, 'cuts')->textInput() ?>

    <?= $form->field($model, 'width_label')->textInput() ?>

    <?= $form->field($model, 'height_label')->textInput() ?>

    <?= $form->field($model, 'knife_kind_id')->textInput() ?>

    <?= $form->field($model, 'knife_width')->textInput() ?>

    <?= $form->field($model, 'picture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'radius')->textInput() ?>

    <?= $form->field($model, 'gap')->textInput() ?>

    <?= $form->field($model, 'material_group_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
