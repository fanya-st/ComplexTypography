<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderCmsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_of_create') ?>

    <?= $form->field($model, 'status_id') ?>

    <?= $form->field($model, 'label_id') ?>

    <?= $form->field($model, 'date_of_sale') ?>

    <?php // echo $form->field($model, 'date_of_print_begin') ?>

    <?php // echo $form->field($model, 'date_of_print_end') ?>

    <?php // echo $form->field($model, 'date_of_packing_begin') ?>

    <?php // echo $form->field($model, 'date_of_packing_end') ?>

    <?php // echo $form->field($model, 'date_of_rewind_begin') ?>

    <?php // echo $form->field($model, 'date_of_rewind_end') ?>

    <?php // echo $form->field($model, 'mashine_id') ?>

    <?php // echo $form->field($model, 'plan_circulation') ?>

    <?php // echo $form->field($model, 'actual_circulation') ?>

    <?php // echo $form->field($model, 'trial_circulation') ?>

    <?php // echo $form->field($model, 'sending') ?>

    <?php // echo $form->field($model, 'material_id') ?>

    <?php // echo $form->field($model, 'printer_login') ?>

    <?php // echo $form->field($model, 'order_price') ?>

    <?php // echo $form->field($model, 'order_price_with_tax') ?>

    <?php // echo $form->field($model, 'delivery_price') ?>

    <?php // echo $form->field($model, 'pants_price') ?>

    <?php // echo $form->field($model, 'label_price') ?>

    <?php // echo $form->field($model, 'label_price_with_tax') ?>

    <?php // echo $form->field($model, 'rewinder_login') ?>

    <?php // echo $form->field($model, 'packer_login') ?>

    <?php // echo $form->field($model, 'rewinder_note') ?>

    <?php // echo $form->field($model, 'printer_note') ?>

    <?php // echo $form->field($model, 'tech_note') ?>

    <?php // echo $form->field($model, 'sleeve_id') ?>

    <?php // echo $form->field($model, 'winding_id') ?>

    <?php // echo $form->field($model, 'diameter_roll') ?>

    <?php // echo $form->field($model, 'label_on_roll') ?>

    <?php // echo $form->field($model, 'cut_edge') ?>

    <?php // echo $form->field($model, 'stretch') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
