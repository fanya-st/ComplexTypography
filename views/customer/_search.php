<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use app\models\User;
use kartik\label\LabelInPlace;
use app\models\CustomerStatus;

?>
<?php $form = ActiveForm::begin([
        'action' => ['customer/list'],
        'method' => 'post',
    ])?>

<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1"><?=$form->field($model,'id')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?=$form->field($model,'name')
                    ->widget(LabelInPlace::class,[
                        'type' => LabelInPlace::TYPE_HTML5,
                        'options' => ['type' => 'text']
                    ])
                ?></div>
            <div class="p-1 flex-lg-fill"><?=$form->field($model,'manager_login')->widget(Select2::class, [
                    'data' => (User::findUsersByGroup('manager')),
                    'options' => ['placeholder' => 'Выбрать менеджера ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?=$form->field($model,'status_id')->widget(Select2::class, [
                    'data' => CustomerStatus::$customer_status,
                    'options' => ['placeholder' => 'Статус заказчика ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
        </div>
        <div class="p-1"><?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>
<?php ActiveForm::end() ?>
