<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Warehouse;

?>

<div class="rack-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo  $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo  $form->field($model, 'warehouse_id')->dropDownList(ArrayHelper::map(Warehouse::find()->asArray()->all(),'id','name')) ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
