<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Pants;
use app\models\Shaft;
use app\models\Customer;
use app\models\LabelStatus;
use app\models\User;
use kartik\daterange\DateRangePicker;
use kartik\label\LabelInPlace;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);
?>
    <div class="label-search">
<?php $form = ActiveForm::begin([
    'action' => ['label/list'],
    'method' => 'post',
]) ?>

<div class="row border p-3 rounded-lg">
    <div class="col">
        <?=$form->field($model,'name',[])->widget(LabelInPlace::classname(),[
            'type' => LabelInPlace::TYPE_HTML5,
            'options' => ['type' => 'text']
        ])?>
        <?=$form->field($model,'id')->widget(LabelInPlace::classname(),[
            'type' => LabelInPlace::TYPE_HTML5,
            'options' => ['type' => 'text']
        ])?>
        <?=$form->field($model,'manager_login')->widget(Select2::classname(), [
            'data' => (User::findUsersByGroup('manager')),
            'options' => ['placeholder' => 'Выбрать менеджера'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false)?>
        <div class="form-group">
            <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col">
        <?=$form->field($model,'designer_login')->widget(Select2::classname(), [
            'data' => (User::findUsersByGroup('designer')),
            'options' => ['placeholder' => 'Выбрать дизайнера'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false)?>
        <?=$form->field($model,'customer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1'])->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать заказчика'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false)?>
        <?=$form->field($model,'status_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(LabelStatus::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Статус этикетки'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false)?>
    </div>
    <div class="col">
<!--        --><?//=$form->field($model,'shaft_id')->widget(Select2::classname(), [
//            'data' => ArrayHelper::map(Shaft::find()->all(), 'id', 'name'),
//            'options' => ['placeholder' => 'Выбрать вал'],
//            'pluginOptions' => [
//                'allowClear' => true,
//            ],
//        ])->label(false)?>
        <?= $form->field($model, 'pants_id')->widget(Select2::class, [
            'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'id'),
            'options' => ['placeholder' => 'Выбрать штанец'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false)?>
        <?=$form->field($model,'date_of_create')->widget(DateRangePicker::classname(),['options' => ['placeholder' => 'Дата создания'],'presetDropdown' => true,'pluginOptions' => [
                'opens'=>'left'
            ]])->label(false)?>
    </div>
</div>
<?php ActiveForm::end() ?>
    </div>
