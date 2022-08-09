<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

?>

<div class="customer-form-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'date_of_create')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'date_of_agreement')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'status_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manager_login')->dropDownList(User::findUsersByGroup('manager')) ?>

<!--    --><?//= $form->field($model, 'subject_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'region_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'town_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'street_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'house')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
<!---->
<!--    --><?//= $form->field($model, 'time_to_delivery_from')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'time_to_delivery_to')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
