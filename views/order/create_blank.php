<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Mashine;
use kartik\date\DatePicker;
use app\models\Material;
use app\models\Sleeve;
use app\models\Winding;
use yii\web\View;
use app\models\Customer;
use app\models\Pants;
use app\models\Shaft;

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
    ",
    View::POS_HEAD,
    'change_sending'
);
//$this->registerJs(
//    "
//    $('#orderform-label_id').on('select2:select', function (e) {
//    var data = document.getElementById('orderform-label_id').value;
//    console.log(data);
//    });
//    ",
//    View::POS_LOAD,
//    'changeOrderName'
//);
?>

    <h1><?= Html::encode($this->title) ?></h1>
<!--<pre>--><?//print_r(date('Y-m-d', strtotime("+ 7 day")))?><!--</pre>-->
<!--<pre>--><?//print_r($order)?><!--</pre>-->
	<?$form = ActiveForm::begin()?>
    <div class="media border p-3 rounded">
            <div class="media-body">
                <div class="alert alert-info">
                    <strong>Внимание!</strong> Этикетка будет создана "на лету" со статусом - готовая</a>.
                </div>
                <h5 class="mt-0">Параметры этикетки</h5>
                <div class="row">
                    <div class="col">
                        <?=$form->field($label,'name')->textInput()?>
                        <?=$form->field($label,'orientation')->dropDownList([
                            '0' => 'Не указана',
                            '1' => 'Альбомная',
                            '2'=>'Книжная'
                        ],
                            [
                                'prompt' => 'Выберите...'
                            ])?>
                    </div>
                    <div class="col">
                        <?=$form->field($label,'customer_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1','manager_login'=>Yii::$app->user->identity->username])->all(), 'id', 'name'),
                            'options' => ['placeholder' => 'Выбрать заказчика ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])?>
                        <div class="row">
                            <div class="col">
                                <?=$form->field($label,'pants_id')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'name'),
                                    'options' => ['placeholder' => 'Выбрать штанец ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])?>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    <div class="media border p-3 rounded">
        <div class="media-body">
            <h5 class="mt-0">Параметры заказа</h5>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <?=$form->field($order,'plan_circulation')->textInput(['onchange'=>'changeSending()'])?>
                            <?=$form->field($order,'label_price')->textInput(['onchange'=>'changeLabelPriceTax()'])?>
                            <?=$form->field($order,'label_price_with_tax')->textInput()?>
                            <?=$form->field($order,'trial_circulation')->dropDownList([
                                '0' => 'Нет',
                                '1' => 'Да'
                            ],
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
                        </div>
                        <div class="col">
                            <?=$form->field($order,'sending')?>
                            <?=$form->field($order,'order_price')->textInput()?>
                            <?=$form->field($order,'order_price_with_tax')->textInput()?>
                            <?=$form->field($order,'sleeve_id')->dropDownList(ArrayHelper::map(Sleeve::find()->all(), 'id', 'name'),
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
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <?=$form->field($order,'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->all(), 'id', 'name'), [
                                'prompt' => 'Выберите...'
                            ])?>
                        </div>
                        <div class="col">
                            <?=$form->field($order,'date_of_sale')->widget(DatePicker::classname(), [
                                'options' => ['placeholder' => 'Введите дату сдачи ...'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd',
                                    'startDate' => date('Y-m-d', strtotime("+ 7 day"))
                                ]
                            ])?>
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
                            return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value]) ." $value ". Html::img(Winding::findOne($value)->image, ['width'=>'90px']) . '</label>';
                        }
                    ])?>
                    <div class="row">
                        <div class="col">
                            <?=$form->field($order,'diameter_roll')?>
                        </div>
                        <div class="col">
                            <?=$form->field($order,'label_on_roll')?>
                        </div>
                    </div>
                    <?=$form->field($order,'rewinder_note')->textarea()?>
                </div>
            </div>
            <?=Html::submitButton('Создать заказ',['class'=>'btn btn-success'])?>
        </div>
        <?=$form->field($order, 'manager_login')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false);?>
        <?=$form->field($order, 'status_id')->hiddenInput(['value' => 1])->label(false);?>
        <?=$form->field($label, 'manager_login')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false);?>
        <?=$form->field($label, 'status_id')->hiddenInput(['value' => 11])->label(false);?>
        <?=$form->field($label, 'embossing')->hiddenInput(['value' => 0])->label(false);?>
        <?=$form->field($label, 'output_label_id')->hiddenInput(['value' => 1])->label(false);?>
        <?=$form->field($label, 'background_id')->hiddenInput(['value' => 1])->label(false);?>
        <?=$form->field($label, 'print_on_glue')->hiddenInput(['value' => 0])->label(false);?>
        <?=$form->field($label, 'varnish_id')->hiddenInput(['value' => 0])->label(false);?>
        <?=$form->field($label, 'variable')->hiddenInput(['value' => 0])->label(false);?>
        <?=$form->field($label, 'stencil')->hiddenInput(['value' => 0])->label(false);?>
        <?=$form->field($label, 'laminate')->hiddenInput(['value' => 0])->label(false);?>
        <?=$form->field($label, 'color_count')->hiddenInput(['value' => 0])->label(false);?>
        <?=$form->field($label, 'foil_width')->hiddenInput(['value' => 0])->label(false);?>
    </div>
	<?ActiveForm::end()?>