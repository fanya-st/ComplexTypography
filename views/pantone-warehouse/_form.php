<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pantone;

?>

<div class="pantone-warehouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo  $form->field($model, 'pantone_id')->dropDownList(ArrayHelper::map(Pantone::find()->asArray()->all(),'id','name')) ?>

    <?php echo  $form->field($model, 'weight')->textInput() ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
