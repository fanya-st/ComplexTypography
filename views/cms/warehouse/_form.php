<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

?>

<div class="warehouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo  $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
