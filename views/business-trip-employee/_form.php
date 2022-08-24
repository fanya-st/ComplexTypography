<?php

use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use app\models\Transport;
use yii\bootstrap5\ActiveForm;
use kartik\date\DatePicker;


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

<!--    --><?//= $form->field($model, 'employee_login')->hiddenInput('value'=>Yii::$app->user->identity->username) ?>

    <?= $form->field($model, 'transport_id')->dropDownList(ArrayHelper::map(Transport::find()->asArray()->all(),'id','name')) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
