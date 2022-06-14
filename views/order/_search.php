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
use app\models\LabelStatus;
use kartik\icons\FontAwesomeAsset;
use kartik\label\LabelInPlace;
FontAwesomeAsset::register($this);

?>
    <div class="order-search">
<?php $form = ActiveForm::begin([
    'action' => ['order/list'],
    'method' => 'post',
])?>
<div class="row border p-3 rounded-lg">
    <div class="col">
        <?=$form->field($model,'labelName')
            ->widget(LabelInPlace::classname(),[
            'type' => LabelInPlace::TYPE_HTML5,
            'options' => ['type' => 'text']
        ])
        ?>
        <?=$form->field($model,'id')->widget(LabelInPlace::classname(),[
            'type' => LabelInPlace::TYPE_HTML5,
            'options' => ['type' => 'text']
        ])?>
        <?=$form->field($model,'label_id')->widget(LabelInPlace::classname(),[
            'type' => LabelInPlace::TYPE_HTML5,
            'options' => ['type' => 'text']
        ])?>
        <div class="form-group">
            <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col">
        <?=$form->field($model,'manager_login')->widget(Select2::classname(), [
            'data' => (User::findUsersByGroup('manager')),
            'options' => ['placeholder' => 'Выбрать менеджера ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false)?>
        <?=$form->field($model,'customerId')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1'])->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать заказчика ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false)?>
        <?= $form->field($model, 'pantsId')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать штанец ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false)?>
        <?= $form->field($model, 'mashine_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Mashine::find()->all(),
                'id', 'name'),
            'options' => ['placeholder' => 'Выбрать машину ...'],
            'pluginOptions' => [
                'allowClear' => true,
//                'multiple' => true
            ],
        ])->label(false)?>
    </div>
    <div class="col">
        <?=$form->field($model,'date_of_create')->widget(DateRangePicker::classname(),
            ['presetDropdown' => true,
                'options' => ['placeholder' => 'Дата создания ...'],
                'pluginOptions' =>
                    [
                'opens'=>'left'
            ]])->label(false)?>
        <?= $form->field($model, 'status_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(OrderStatus::find()->all(),
                'id', 'name'),
            'options' => ['placeholder' => 'Статус заказа ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false)?>
        <?= $form->field($model, 'label_status_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(LabelStatus::find()
                ->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Статус этикетки ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false)?>
        <?= $form->field($model, 'shaft_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Shaft::find()->all(), 'id',
                'name'),
            'options' => ['placeholder' => 'Выбрать вал ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false)?>
    </div>
</div>
<?php ActiveForm::end() ?>
    </div>
