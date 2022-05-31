<?php
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Pants;
use app\models\Shaft;
use app\models\Customer;
use app\models\LabelStatus;
use app\models\User;
use kartik\daterange\DateRangePicker;

?>
    <div class="label-search">
<?php $form = ActiveForm::begin([
    'action' => ['label/list'],
    'method' => 'post',
])?>

<div class="row border p-3 rounded-lg">
    <div class="col">
        <?=$form->field($model,'name',[])?>
        <?=$form->field($model,'id')?>
        <?=$form->field($model,'manager_login')->dropDownList(User::findUsersByGroup('manager'), [
            'prompt' => ''
        ])?>
        <div class="form-group">
            <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col">
        <?=$form->field($model,'designer_login')->dropDownList(User::findUsersByGroup('designer'), [
            'prompt' => ''
        ])?>
        <?=$form->field($model,'customer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1'])->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать заказчика ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])?>
        <?=$form->field($model,'status_id')->dropdownList(ArrayHelper::map(LabelStatus::find()->all(), 'id', 'name'), [
            'prompt' => ''
        ])?>
    </div>
    <div class="col">
        <?=$form->field($model,'shaft_id')
            ->dropDownList(ArrayHelper::map(Shaft::find()->all(), 'id',
                'name'), [
                'prompt' => ''
            ])?>
        <?= $form->field($model, 'pants_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать штанец ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])?>
        <?=$form->field($model,'date_of_create')->widget(DateRangePicker::classname(),['presetDropdown' => true,'pluginOptions' => [
                'opens'=>'left'
            ]])?>
    </div>
</div>
<?php ActiveForm::end() ?>
    </div>
