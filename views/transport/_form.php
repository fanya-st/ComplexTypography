<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/** @var \app\models\Transport $model */

?>

<div class="transport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo  $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo  $form->field($model, 'car_number')->textInput(['maxlength' => true]) ?>

    <?php echo  $form->field($model, 'load_capacity')->textInput() ?>

    <?php echo  $form->field($model, 'subscribe')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
