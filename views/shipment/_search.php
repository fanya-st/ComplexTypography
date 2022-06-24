<?php

use app\models\Shipment;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\User;
use kartik\date\DatePicker;
use yii\bootstrap5\Modal;
use kartik\icons\FontAwesomeAsset;
use kartik\label\LabelInPlace;
FontAwesomeAsset::register($this);

?>
    <?php $form = ActiveForm::begin([
        'action' => ['shipment/list'],
        'method' => 'post',
    ])?>
    <div class="row border p-3 rounded-lg">
        <div class="col">
            <?=$form->field($model,'id')->widget(LabelInPlace::classname(),[
                'type' => LabelInPlace::TYPE_HTML5,
                'options' => ['type' => 'text']
            ])?>
            <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Создать отгрузку', ['/shipment/create'], ['class'=>'btn btn-primary']) ?>
        </div>
        <div class="col">
            <?=$form->field($model,'manager_login')->widget(Select2::classname(), [
                'data' => (User::findUsersByGroup('manager')),
                'options' => ['placeholder' => 'Выбрать менеджера ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false)?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
