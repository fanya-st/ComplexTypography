<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
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

    <?php $form = ActiveForm::begin() ?>

<div class="d-lg-flex flex-wrap justify-content-around">
    <div class="p-1"><?= $form->field($model, 'parent_label')->textInput() ?></div>
    <div class="p-1"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
    <div class="p-1"><?= $form->field($model, 'designer_note')->textarea(['rows' => 1]) ?></div>
    <div class="p-1"><?= $form->field($model, 'manager_note')->textarea(['rows' => 1]) ?></div>
    <div class="p-1"><?= $form->field($model, 'date_of_design')->textInput() ?></div>
    <div class="p-1"><?= $form->field($model, 'customer_id')->widget(Select2::class, [
            'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1'])->asArray()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать заказчика ...'],
        ]) ?></div>
    <div class="p-1"><?= $form->field($model, 'status_id')->dropDownList(LabelStatus::$label_status) ?></div>

    <div class="p-1"><?= $form->field($model, 'pants_id')->dropDownList(ArrayHelper::map(Pants::find()->asArray()->all(),'id','id')) ?></div>

    <div class="p-1"><?= $form->field($model, 'foil_id')->dropDownList(ArrayHelper::map(Foil::find()->asArray()->all(),'id','name')) ?></div>

    <div class="p-1"><?= $form->field($model, 'varnish_id')->dropDownList(ArrayHelper::map(VarnishStatus::find()->asArray()->all(),'id','name')) ?></div>

    <div class="p-1"><?= $form->field($model, 'laminate')->dropDownList([0=>'Нет',1=>'Да',]) ?></div>

    <div class="p-1"><?= $form->field($model, 'stencil')->dropDownList([0=>'Нет',1=>'Да',]) ?></div>

    <div class="p-1"><?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?></div>

    <div class="p-1"><?= $form->field($model, 'image_crop')->textInput(['maxlength' => true]) ?></div>

    <div class="p-1"><?= $form->field($model, 'output_label_id')->dropDownList(ArrayHelper::map(OutputLabel::find()->asArray()->all(),'id','name')) ?></div>

    <div class="p-1"><?= $form->field($model, 'background_id')->dropDownList(ArrayHelper::map(BackgroundLabel::find()->asArray()->all(),'id','name')) ?></div>

    <div class="p-1"><?= $form->field($model, 'orientation')->dropDownList([0 => 'Не указана',
        1 => 'Альбомная',
        2=>'Книжная']) ?></div>

    <div class="p-1"><?= $form->field($model, 'image_extended')->textInput(['maxlength' => true]) ?></div>

    <div class="p-1"><?= $form->field($model, 'design_file')->textInput(['maxlength' => true]) ?></div>

    <div class="p-1"><?= $form->field($model, 'color_count')->textInput() ?></div>

    <div class="p-1"><?= $form->field($model, 'takeoff_flash')->dropDownList([0=>'Нет',1=>'Да',]) ?></div>

    <div class="p-1"><?= $form->field($model, 'print_on_glue')->dropDownList([0=>'Нет',1=>'Да',]) ?></div>

    <div class="p-1"><?= $form->field($model, 'variable')->dropDownList([0=>'Нет',1=>'Да',]) ?></div>
</div>
<div class="d-lg-flex flex-wrap">
    <div class="p-1"><?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?></div>
</div>
<?php ActiveForm::end() ?>
