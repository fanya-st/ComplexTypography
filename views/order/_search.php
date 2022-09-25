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
use kartik\label\LabelInPlace;

?>
<?php $form = ActiveForm::begin([
    'action' => ['order/list'],
    'method' => 'post',
])?>
<div class="text-nowrap">
        <div class="border p-3 rounded">
            <div class="d-lg-flex flex-wrap justify-content-between">
                <div class="p-1"><?php echo $form->field($model,'labelName')
                        ->widget(LabelInPlace::class,[
                            'type' => LabelInPlace::TYPE_HTML5,
                            'options' => ['type' => 'text']
                        ])
                    ?></div>
                <div class="p-1"><?php echo $form->field($model,'id')->widget(LabelInPlace::class,[
                        'type' => LabelInPlace::TYPE_HTML5,
                        'options' => ['type' => 'text']
                    ])?></div>
                <div class="p-1"><?php echo $form->field($model,'label_id')->widget(LabelInPlace::class,[
                        'type' => LabelInPlace::TYPE_HTML5,
                        'options' => ['type' => 'text']
                    ])?></div>
                <div class="p-1"><?php echo  $form->field($model, 'mashine_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Mashine::find()->all(),
                            'id', 'name'),
                        'options' => ['placeholder' => 'Выбрать машину ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
//                'multiple' => true
                        ],
                    ])->label(false)?></div>
                <div class="p-1"><?php echo  $form->field($model, 'status_id')->widget(Select2::class, [
                        'data' => OrderStatus::$order_status,
                        'options' => ['placeholder' => 'Статус заказа ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false)?></div>
                <div class="p-1"><?php echo  $form->field($model, 'label_status_id')
                        ->widget(Select2::class, [
                            'data' => LabelStatus::$label_status,
                            'options' => ['placeholder' => 'Статус этикетки ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                        ->label(false)?></div>
                <div class="p-1"><?php echo  $form->field($model, 'shaft_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Shaft::find()->all(), 'id',
                            'name'),
                        'options' => ['placeholder' => 'Выбрать вал ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false)?></div>
                <div class="p-1"><?php echo $form->field($model,'manager_id')->widget(Select2::class, [
                        'data' => (User::findUsersByGroup('manager')),
                        'options' => ['placeholder' => 'Выбрать менеджера ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false)?></div>
                <div class="p-1"><?php echo  $form->field($model, 'pants_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'id'),
                        'options' => ['placeholder' => 'Выбрать штанец ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false)?></div>
                <div class="p-1"><?php echo $form->field($model,'customer_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1'])->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Выбрать заказчика ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false)?></div>
                <div class="p-1"><?php echo $form->field($model,'date_of_create')->widget(DateRangePicker::class,
                        ['presetDropdown' => true,
                            'options' => ['placeholder' => 'Дата создания ...'],
                            'pluginOptions' =>
                                [
                                    'opens'=>'left'
                                ]])->label(false)?></div>
            </div>
        </div>
    <div class="p-1"><?php echo  Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
</div>

<?php ActiveForm::end() ?>
