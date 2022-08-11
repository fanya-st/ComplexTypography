<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Customer;
use app\models\LabelStatus;
use app\models\Pants;
use app\models\Foil;
use app\models\VarnishStatus;
use app\models\OutputLabel;
use app\models\BackgroundLabel;

?>

<div class="label-form-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'parent_label')->textInput() ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'designer_note')->textarea(['rows' => 1]) ?>

            <?= $form->field($model, 'manager_note')->textarea(['rows' => 1]) ?>

            <?= $form->field($model, 'date_of_design')->textInput() ?>

            <?= $form->field($model, 'customer_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1'])->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Выбрать заказчика ...'],
            ]) ?>

            <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map(LabelStatus::find()->asArray()->all(),'id','name')) ?>

            <?= $form->field($model, 'pants_id')->dropDownList(ArrayHelper::map(Pants::find()->asArray()->all(),'id','name')) ?>

            <?= $form->field($model, 'foil_id')->dropDownList(ArrayHelper::map(Foil::find()->asArray()->all(),'id','name')) ?>

            <?= $form->field($model, 'varnish_id')->dropDownList(ArrayHelper::map(VarnishStatus::find()->asArray()->all(),'id','name')) ?>

            <?= $form->field($model, 'laminate')->dropDownList([0=>'Нет',1=>'Да',]) ?>

        </div>
        <div class="col">
            <?= $form->field($model, 'stencil')->dropDownList([0=>'Нет',1=>'Да',]) ?>

            <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'image_crop')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'output_label_id')->dropDownList(ArrayHelper::map(OutputLabel::find()->asArray()->all(),'id','name')) ?>

            <?= $form->field($model, 'background_id')->dropDownList(ArrayHelper::map(BackgroundLabel::find()->asArray()->all(),'id','name')) ?>

            <?= $form->field($model, 'orientation')->dropDownList([0 => 'Не указана',
                1 => 'Альбомная',
                2=>'Книжная']) ?>

            <?= $form->field($model, 'image_extended')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'design_file')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'color_count')->textInput() ?>

            <?= $form->field($model, 'takeoff_flash')->dropDownList([0=>'Нет',1=>'Да',]) ?>

            <?= $form->field($model, 'print_on_glue')->dropDownList([0=>'Нет',1=>'Да',]) ?>

            <?= $form->field($model, 'variable')->dropDownList([0=>'Нет',1=>'Да',]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
