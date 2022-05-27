<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Mashine;
use kartik\date\DatePicker;
use app\models\Material;
use app\models\Sleeve;
use app\models\Winding;
use yii\web\View;
use app\models\Label;

$this->title = 'Создание заказа для пустышек';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile("https://use.fontawesome.com/releases/v5.3.1/css/all.css");
$this->registerJs(
    "
    function changeSending(){
    document.getElementById('orderform-sending').value=document.getElementById('orderform-plan_circulation').value;
    document.getElementById('orderform-order_price').value=document.getElementById('orderform-label_price').value*document.getElementById('orderform-sending').value;
    document.getElementById('orderform-order_price_with_tax').value=document.getElementById('orderform-label_price_with_tax').value*document.getElementById('orderform-sending').value;
    }
    function changeLabelPriceTax(){
    document.getElementById('orderform-label_price_with_tax').value=document.getElementById('orderform-label_price').value*1.2;
    document.getElementById('orderform-order_price').value=document.getElementById('orderform-label_price').value*document.getElementById('orderform-sending').value;
    document.getElementById('orderform-order_price_with_tax').value=document.getElementById('orderform-label_price_with_tax').value*document.getElementById('orderform-sending').value;
    }
    function changeOrderName(){
    document.getElementById('orderform-name').value=document.getElementById('labelform-name').value;
   
    }
    ",
    View::POS_HEAD,
    'change_sending'
);
?>
    <h1><?= Html::encode($this->title) ?></h1>
<!--    <div class="alert alert-info">-->
<!--        <strong>Внимание!</strong> Этикетка будет создана "на лету" со статусом - готовая</a>.-->
<!--    </div>-->
	<?$form = ActiveForm::begin()?>
    <div class="row">
        <div class="col">
            <?=$form->field($order,'label_id')->widget(Select2::classname(),
                ['data' => ArrayHelper::map(Label::find()->where(['manager_login'=>Yii::$app->user->identity->username])
                    ->orderBy(['date_of_create'=>SORC_DESC])->limit(100)->all(), 'id', 'nameSplitId'),
                'options' => ['placeholder' => 'Выбрать этикетку ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])?>
            <div class="row">
                <div class="col">
                    <?=$form->field($order,'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->all(), 'id', 'name'), [
                        'prompt' => 'Выберите...'
                    ])?>
                    <?=$form->field($order,'label_price')->textInput(['onchange'=>'changeLabelPriceTax()'])?>
                    <?=$form->field($order,'order_price')->textInput()?>
                </div>
                <div class="col">
                    <?=$form->field($order,'date_of_sale')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Введите дату сдачи ...'],
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ])?>
                    <?=$form->field($order,'label_price_with_tax')->textInput()?>
                    <?=$form->field($order,'order_price_with_tax')->textInput()?>
                </div>
            </div>
            <?=$form->field($order,'material_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Material::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Выбрать материал ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])?>
            <?=$form->field($order,'winding_id')->radioList(ArrayHelper::map(Winding::find()->all(),'id', 'name'),[
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value]) ." $value ". Html::img(Winding::findOne($value)->image, ['width'=>'100px']) . '</label>';
                }
            ])?>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <?=$form->field($order,'trial_circulation')->dropDownList([
                        '0' => 'Нет',
                        '1' => 'Да'
                    ],
                        [
                            'prompt' => 'Выберите...'
                        ])?>
                    <?=$form->field($order,'sleeve_id')->dropDownList(ArrayHelper::map(Sleeve::find()->all(), 'id', 'name'),
                        [
                            'prompt' => 'Выберите...'
                        ])?>
                    <?=$form->field($order,'cut_edge')->dropDownList([
                        '0' => 'Не срезать',
                        '1' => 'Срезать',
                    ],
                        [
                            'prompt' => 'Выберите...'
                        ])?>
                    <?=$form->field($order,'stretch')->dropDownList([
                        '0' => 'Нет',
                        '1' => 'Да',
                    ],
                        [
                            'prompt' => 'Выберите...'
                        ])?>
                </div>
                <div class="col">
                    <?=$form->field($order,'plan_circulation')->textInput(['onchange'=>'changeSending()'])?>
                    <?=$form->field($order,'sending')?>
                    <?=$form->field($order,'diameter_roll')?>
                    <?=$form->field($order,'label_on_roll')?>
                </div>
            </div>
            <?=$form->field($order,'rewinder_note')->textarea()?>
        </div>
    </div>
    <?=$form->field($order, 'manager_login')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false);?>
    <?=$form->field($order, 'name')->hiddenInput()->label(false);?>
	<?=Html::submitButton('Создать заказ',['class'=>'btn btn-success'])?>
	<?ActiveForm::end()?>