<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Customer;
use kartik\select2\Select2;
use kartik\date\DatePicker;


?>
<div class="bank-transfer-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Customer::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Выбрать заказчика ...'],
        'pluginOptions' => [
//                'allowClear' => true
        ],
    ])?>

    <?= $form->field($model, 'date')->widget(
            DatePicker::className(),[
            'options' => ['placeholder' => 'Введите дату ...'],
            'pluginOptions' => [
                'todayHighlight' => true,
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]
    ) ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
