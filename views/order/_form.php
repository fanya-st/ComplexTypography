<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo  $form->field($order, 'date_of_create')->textInput() ?>

    <?php echo  $form->field($model, 'status_id')->textInput() ?>

    <?php echo  $form->field($model, 'label_id')->textInput() ?>

    <?php echo  $form->field($model, 'date_of_sale')->textInput() ?>

    <?php echo  $form->field($model, 'date_of_print_end')->textInput() ?>

    <?php echo  $form->field($model, 'date_of_variable_print_begin')->textInput() ?>

    <?php echo  $form->field($model, 'date_of_variable_print_end')->textInput() ?>

    <?php echo  $form->field($model, 'date_of_packing_begin')->textInput() ?>

    <?php echo  $form->field($model, 'date_of_packing_end')->textInput() ?>

    <?php echo  $form->field($model, 'date_of_rewind_begin')->textInput() ?>

    <?php echo  $form->field($model, 'date_of_rewind_end')->textInput() ?>

    <?php echo  $form->field($model, 'mashine_id')->textInput() ?>

    <?php echo  $form->field($model, 'plan_circulation')->textInput() ?>

    <?php echo  $form->field($model, 'printed_circulation')->textInput() ?>

    <?php echo  $form->field($model, 'sending')->textInput() ?>

    <?php echo  $form->field($model, 'material_id')->textInput() ?>

    <?php echo  $form->field($model, 'printer_id')->textInput() ?>

    <?php echo  $form->field($model, 'label_price')->textInput() ?>

    <?php echo  $form->field($model, 'label_price_with_tax')->textInput() ?>

    <?php echo  $form->field($model, 'rewinder_id')->textInput() ?>

    <?php echo  $form->field($model, 'packer_id')->textInput() ?>

    <?php echo  $form->field($model, 'rewinder_note')->textarea(['rows' => 6]) ?>

    <?php echo  $form->field($model, 'printer_note')->textarea(['rows' => 6]) ?>

    <?php echo  $form->field($model, 'manager_note')->textarea(['rows' => 6]) ?>

    <?php echo  $form->field($model, 'tech_note')->textarea(['rows' => 6]) ?>

    <?php echo  $form->field($model, 'sleeve_id')->textInput() ?>

    <?php echo  $form->field($model, 'winding_id')->textInput() ?>

    <?php echo  $form->field($model, 'label_on_roll')->textInput() ?>

    <?php echo  $form->field($model, 'cut_edge')->textInput() ?>

    <?php echo  $form->field($model, 'stretch')->textInput() ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
