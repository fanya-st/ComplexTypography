<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Pants;
use app\models\Customer;
use app\models\LabelStatus;
use app\models\User;
use kartik\daterange\DateRangePicker;
use kartik\label\LabelInPlace;
?>
<?php $form = ActiveForm::begin([
    'action' => ['label/list'],
    'method' => 'post',
]) ?>
<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1"><?=$form->field($model,'name',[])->widget(LabelInPlace::class,[
            'type' => LabelInPlace::TYPE_HTML5,
            'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?=$form->field($model,'id')->widget(LabelInPlace::class,[
            'type' => LabelInPlace::TYPE_HTML5,
            'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1 flex-fill"><?=$form->field($model,'manager_login')->widget(Select2::class, [
            'data' => (User::findUsersByGroup('manager')),
            'options' => ['placeholder' => 'Выбрать менеджера'],
            'pluginOptions' => [
                'allowClear' => true
            ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?=$form->field($model,'designer_login')->widget(Select2::class, [
            'data' => (User::findUsersByGroup('designer')),
            'options' => ['placeholder' => 'Выбрать дизайнера'],
            'pluginOptions' => [
                'allowClear' => true
            ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?=$form->field($model,'customer_id')->widget(Select2::class, [
            'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1'])->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать заказчика'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?=$form->field($model,'status_id')->widget(Select2::class, [
            'data' => LabelStatus::$label_status,
            'options' => ['placeholder' => 'Статус этикетки'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?= $form->field($model, 'pants_id')->widget(Select2::class, [
            'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'id'),
            'options' => ['placeholder' => 'Выбрать штанец'],
            'pluginOptions' => [
                'allowClear' => true
            ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?=$form->field($model,'date_of_create')->widget(DateRangePicker::class,['options' => ['placeholder' => 'Дата создания'],'presetDropdown' => true,'pluginOptions' => [
                'opens'=>'left'
                ]])->label(false)?></div>
        </div>
    </div>
    <div class="p-1"><?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
</div>
<?php ActiveForm::end() ?>