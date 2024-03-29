<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use kartik\label\LabelInPlace;
use yii\helpers\ArrayHelper;
use app\models\User;
use kartik\daterange\DateRangePicker;
use app\models\EnterpriseCostService;

?>
<?php $form = ActiveForm::begin(['action' => ['enterprise-cost/index'], 'method' => 'post'])?>

<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1"><?php echo $form->field($model,'id')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?php echo $form->field($model,'order_id')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?php echo $form->field($model,'cost')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
        </div>
        <div class="d-lg-flex flex-wrap">
            <div class="p-1 flex-fill"><?php echo $form->field($model,'user_id')->widget(Select2::class, [
                    'data' => User::findUsersIdDropdown(),
                    'options' => ['placeholder' => 'Выбрать сотрудника'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-lg-fill"><?php echo $form->field($model,'date')->widget(DateRangePicker::class, [
                    'attribute' => 'date',
                    'presetDropdown'=>true,
                    'convertFormat'=>true,
                    'pluginOptions' => ['locale' => ['format' => 'Y-m-d'],'selectOnClose'=>false],
                    'options' => ['placeholder' => 'Выберите дату...']
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?php echo $form->field($model,'service_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(EnterpriseCostService::find()->asArray()->all(),'id','name'),
                    'options' => ['placeholder' => 'Выбрать услугу'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
        </div>
        <div class="p-1"><?php echo  Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>

<?php ActiveForm::end() ?>
