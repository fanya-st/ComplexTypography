<?php

use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use app\models\Transport;
use yii\bootstrap5\ActiveForm;
use kartik\date\DatePicker;
use app\models\Customer;


?>

<div class="business-trip-employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_of_begin')->widget(DatePicker::class,['options' => ['placeholder' => 'Введите дату ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
        ]])  ?>

    <?= $form->field($model, 'date_of_end')->widget(DatePicker::class,['options' => ['placeholder' => 'Введите дату ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
        ]]) ?>

    <?= $form->field($model, 'gasoline_cost')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'transport_id')->dropDownList(ArrayHelper::map(Transport::find()->asArray()->all(),'id','name')) ?>

    <?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map(Customer::find()->asArray()->all(),'id','name')) ?>

    <?= $form->field($model, 'comment')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
