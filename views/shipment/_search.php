<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use app\models\User;
use kartik\label\LabelInPlace;
use kartik\daterange\DateRangePicker;

?>
<?php $form = ActiveForm::begin(['action' => ['shipment/list'], 'method' => 'post',])?>

<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1"><?php echo $form->field($model,'id')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1 flex-fill"><?php echo $form->field($model,'manager_id')->widget(Select2::class, [
                    'data' => (User::findUsersByGroup('manager')),
                    'options' => ['placeholder' => 'Выбрать менеджера'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?php echo $form->field($model,'date_of_create')->widget(DateRangePicker::class,[
                'convertFormat' => true,
                'presetDropdown'=>true,
                'options'=>['placeholder' => 'Дата создания'],
                'pluginOptions' => [
                    'format'=>'Y-m-d',
                    'locale' => [
                        'format' => 'd.m.Y',
                        'separator' => ' | ',
                        ],
                    ],
                    ])->label(false)?></div>
            <div class="p-1 flex-fill"><?php echo $form->field($model,'date_of_send')->widget(DateRangePicker::class,[
                'convertFormat' => true,
                'presetDropdown'=>true,
                'options'=>['placeholder' => 'Дата отправки'],
                'pluginOptions' => [
                    'format'=>'Y-m-d',
                    'locale' => [
                        'format' => 'd.m.Y',
                        'separator' => ' | ',
                        ],
                    ],
                    ])->label(false)?></div>
            </div>
        <div class="p-1"><?php echo  Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>

<?php ActiveForm::end() ?>
