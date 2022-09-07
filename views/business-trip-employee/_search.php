<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use app\models\User;
use kartik\label\LabelInPlace;
use yii\helpers\ArrayHelper;
use app\models\Transport;
use kartik\daterange\DateRangePicker;

?>
<?php $form = ActiveForm::begin([
    'action' => ['business-trip-employee/index'],
    'method' => 'post',
])?>

<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1"><?=$form->field($model,'id')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?=$form->field($model,'address')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1 flex-lg-fill"><?=$form->field($model,'user_id')->widget(Select2::class, [
                    'data' => User::findUsersIdDropdown(),
                    'options' => ['placeholder' => 'Сотрудник ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-lg-fill"><?=$form->field($model,'status_id')->widget(Select2::class, [
                    'data' => \app\models\BusinessTripEmployee::$trip_status,
                    'options' => ['placeholder' => 'Статус ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?=$form->field($model,'transport_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Transport::find()->asArray()->all(),'id','name'),
                    'options' => ['placeholder' => 'Транспорт ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-lg-fill"><?=$form->field($model,'date_range')->widget(DateRangePicker::class, [
                    'attribute' => 'date_range',
                    'presetDropdown'=>true,
                    'convertFormat'=>true,
                    'pluginOptions' => ['locale' => ['format' => 'Y-m-d'],'selectOnClose'=>false],
                    'options' => ['placeholder' => 'Выберите период...']
                ])->label(false)?></div>
        </div>
        <div class="p-1"><?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>
<?php ActiveForm::end() ?>
