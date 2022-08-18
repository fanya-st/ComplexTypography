<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Rack;

?>

<div class="shelf-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rack_id')->dropDownList(ArrayHelper::map(Rack::find()->asArray()->all(),'id','name')) ?>

    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
