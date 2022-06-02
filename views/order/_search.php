<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Pants;
use app\models\Shaft;
use app\models\Customer;
use app\models\OrderStatus;
use app\models\User;
use kartik\daterange\DateRangePicker;
use app\models\Mashine;

?>
    <div class="order-search">
<?php $form = ActiveForm::begin([
    'action' => ['order/list'],
    'method' => 'post',
])?>
<div class="row border p-3 rounded-lg">
    <div class="col">
        <?=$form->field($model,'name',[])?>
        <?=$form->field($model,'id')?>
        <?=$form->field($model,'label_id')?>
        <div class="form-group">
            <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col">
        <?=$form->field($model,'manager_login')->dropDownList(User::findUsersByGroup('manager'), [
            'prompt' => ''
        ])?>
        <?=$form->field($model,'customerId')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1'])->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать заказчика ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])?>
        <?= $form->field($model, 'pantsId')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать штанец ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])?>
        <?=$form->field($model,'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->all(), 'id', 'name'), [
            'prompt' => 'Выберите...'
        ])?>
    </div>
    <div class="col">
        <?=$form->field($model,'date_of_create')->widget(DateRangePicker::classname(),['presetDropdown' => true,'pluginOptions' => [
                'opens'=>'left'
            ]])?>
        <?=$form->field($model,'status_id')->dropdownList(ArrayHelper::map(OrderStatus::find()->all(), 'id', 'name'), [
            'prompt' => ''
        ])?>
        <?=$form->field($model,'shaftId')
            ->dropDownList(ArrayHelper::map(Shaft::find()->all(), 'id',
                'name'), [
                'prompt' => ''
            ])?>
    </div>
</div>
<?php ActiveForm::end() ?>
    </div>
