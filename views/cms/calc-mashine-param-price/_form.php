<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Mashine;
use app\models\CalcMashineParam;


?>

<div class="calc-mashine-param-price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->AsArray()->all(),'id','name')) ?>

    <?= $form->field($model, 'calc_mashine_param_id')->dropDownList(ArrayHelper::map(CalcMashineParam::find()->AsArray()->all(),'id','subscribe')) ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
