<?php

use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Envelope;
use app\models\Shelf;

?>

<div class="envelope-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php echo  $form->field($model, 'color1')->dropDownList(ArrayHelper::map(Envelope::$location['color1'],'id','name'),
        Envelope::getDropDownOptionsColorTwo()) ?>

    <?php echo  $form->field($model, 'color2')->dropDownList(ArrayHelper::map(Envelope::$location['color2'],'id','name'),
        Envelope::getDropDownOptionsColorTwo()) ?>

    <?php echo  $form->field($model, 'shelf_id')
//        ->dropDownList(ArrayHelper::map(Shelf::find()->asArray()->all(),'id','id'))
        ->widget(Select2::class, [
            'data' => ArrayHelper::map(Shelf::find()->asArray()->all(),'id','id'),
            'options' => ['placeholder' => 'Выбрать полку'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
    ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
