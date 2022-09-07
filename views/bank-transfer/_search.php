<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use kartik\label\LabelInPlace;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Customer;
use kartik\daterange\DateRangePicker;

?>
<?php $form = ActiveForm::begin(['action' => ['bank-transfer/index'], 'method' => 'post'])?>

<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1"><?=$form->field($model,'sum')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1 flex-fill"><?=$form->field($model,'customer_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Customer::find()->asArray()->all(),'id','name'),
                    'options' => ['placeholder' => 'Заказчик'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-lg-fill"><?=$form->field($model,'date')->widget(DateRangePicker::class, [
                    'attribute' => 'date',
                    'presetDropdown'=>true,
                    'convertFormat'=>true,
                    'pluginOptions' => ['locale' => ['format' => 'Y-m-d'],'selectOnClose'=>false],
                    'options' => ['placeholder' => 'Выберите дату...']
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?=$form->field($model,'manager_id')->widget(Select2::class, [
                    'data' => User::findUsersByGroup('manager'),
                    'options' => ['placeholder' => 'Менеджер'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
        </div>
        <div class="p-1"><?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>

<?php ActiveForm::end() ?>
