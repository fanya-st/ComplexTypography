<?php

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pants;
use app\models\Mashine;

?>

<div class="mashine-pants-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo  $form->field($model, 'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->asArray()->all(),'id','name')) ?>

    <?php echo  $form->field($model, 'pants_id')->dropDownList(ArrayHelper::map(Pants::find()->asArray()->all(),'id','id')) ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
