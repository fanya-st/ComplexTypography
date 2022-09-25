<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\PolymerKind;
use yii\helpers\ArrayHelper;

?>

<div class="shaft-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo  $form->field($model, 'name')->textInput() ?>

    <?php echo  $form->field($model, 'polymer_kind_id')->dropDownList(ArrayHelper::map(PolymerKind::find()->asArray()->all(),'id','name')) ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
