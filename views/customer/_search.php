<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\User;
use kartik\date\DatePicker;
use kartik\icons\FontAwesomeAsset;
use kartik\label\LabelInPlace;
use app\models\CustomerStatus;
FontAwesomeAsset::register($this);

?>
<div class="order-search">
    <?php $form = ActiveForm::begin([
        'action' => ['customer/list'],
        'method' => 'post',
    ])?>
    <div class="row border p-3 rounded-lg">
        <div class="col">
            <?=$form->field($model,'id')->widget(LabelInPlace::classname(),[
                'type' => LabelInPlace::TYPE_HTML5,
                'options' => ['type' => 'text']
            ])?>
            <?=$form->field($model,'name')
                ->widget(LabelInPlace::classname(),[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])
            ?>
                    <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Добавить заказчика', ['/customer/create'], ['class'=>'btn btn-primary']) ?>
        </div>
        <div class="col">
            <?=$form->field($model,'manager_login')->widget(Select2::classname(), [
                'data' => (User::findUsersByGroup('manager')),
                'options' => ['placeholder' => 'Выбрать менеджера ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false)?>
            <?=$form->field($model,'status_id')->widget(Select2::classname(), [
                'data' => (ArrayHelper::map(CustomerStatus::find()->all(),'id','name')),
                'options' => ['placeholder' => 'Статус заказчика ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false)?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
