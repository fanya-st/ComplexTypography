<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

?>


    <?php $form = ActiveForm::begin() ?>

<p><?= $form->field($model, 'name')->textInput(['maxlength' => true,'disabled'=>true]) ?></p>

<p><?= $form->field($model, 'subscribe')->textInput(['maxlength' => true]) ?></p>

<p><?= $form->field($model, 'value')->textInput() ?></p>


<p><?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?></p>


    <?php ActiveForm::end() ?>

