<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($order, 'date_of_create')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'label_id')->textInput() ?>

    <?= $form->field($model, 'date_of_sale')->textInput() ?>

    <?= $form->field($model, 'date_of_print_end')->textInput() ?>

    <?= $form->field($model, 'date_of_variable_print_begin')->textInput() ?>

    <?= $form->field($model, 'date_of_variable_print_end')->textInput() ?>

    <?= $form->field($model, 'date_of_packing_begin')->textInput() ?>

    <?= $form->field($model, 'date_of_packing_end')->textInput() ?>

    <?= $form->field($model, 'date_of_rewind_begin')->textInput() ?>

    <?= $form->field($model, 'date_of_rewind_end')->textInput() ?>

    <?= $form->field($model, 'mashine_id')->textInput() ?>

    <?= $form->field($model, 'plan_circulation')->textInput() ?>

    <?= $form->field($model, 'printed_circulation')->textInput() ?>

    <?= $form->field($model, 'sending')->textInput() ?>

    <?= $form->field($model, 'material_id')->textInput() ?>

    <?= $form->field($model, 'printer_id')->textInput() ?>

    <?= $form->field($model, 'label_price')->textInput() ?>

    <?= $form->field($model, 'label_price_with_tax')->textInput() ?>

    <?= $form->field($model, 'rewinder_id')->textInput() ?>

    <?= $form->field($model, 'packer_id')->textInput() ?>

    <?= $form->field($model, 'rewinder_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'printer_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'manager_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tech_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sleeve_id')->textInput() ?>

    <?= $form->field($model, 'winding_id')->textInput() ?>

    <?= $form->field($model, 'label_on_roll')->textInput() ?>

    <?= $form->field($model, 'cut_edge')->textInput() ?>

    <?= $form->field($model, 'stretch')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
