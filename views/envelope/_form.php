<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Envelope;
use app\models\Shelf;

?>

<div class="envelope-form">
<!--    <pre>--><?//print_r(Shelf::find()->with('rack.warehouse')->all())?><!--</pre>-->
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'color1')->dropDownList(ArrayHelper::map(Envelope::$location['color1'],'id','name'),
        Envelope::getDropDownOptionsColorTwo()) ?>

    <?= $form->field($model, 'color2')->dropDownList(ArrayHelper::map(Envelope::$location['color2'],'id','name'),
        Envelope::getDropDownOptionsColorTwo()) ?>

    <?= $form->field($model, 'shelf_id')->dropDownList(ArrayHelper::map(Shelf::find()->joinWith('rack.warehouse')->where(['warehouse.id'=>6])->asArray()->all(),'id','id')) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
