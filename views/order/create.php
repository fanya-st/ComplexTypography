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
use app\models\Label;
use kartik\helpers\Enum;

$this->title = 'Создание заказа';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = $this->title;
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
?>

    <h1><?php echo  Html::encode($this->title) ?></h1>
	<?php $form = ActiveForm::begin()?>
    <div class="row">
        <div class="col">
            <?php echo $form->field($order,'label_id')->widget(Select2::class,
                ['data' => ArrayHelper::map(Label::find()->joinWith('customer')->where(['customer.user_id'=>Yii::$app->user->identity->getId()])->orderBy('date_of_create DESC')->limit(100)->all(),
                    'id', 'nameSplitId'),
                'options' => ['placeholder' => 'Выбрать этикетку ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])?>
            <?php echo $form->field($order,'parent_label')->checkbox()?>
            <div class="row">
                <div class="col">
                    <?php echo $form->field($order,'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->where(['mashine_type'=>0])->asArray()->all(), 'id', 'name'))?>
                    <?php echo $form->field($order,'label_price')->textInput(['onchange'=>'changeLabelPriceTax()'])?>
                </div>
                <div class="col">
                    <?php echo $form->field($order,'date_of_sale')->widget(DatePicker::class, [
                        'options' => ['placeholder' => 'Введите дату сдачи ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            'startDate' => date('Y-m-d', strtotime("+ 7 day"))
                        ]
                    ])?>
                    <?php echo $form->field($order,'label_price_with_tax')->textInput()?>
                </div>
            </div>
            <?php echo $form->field($order,'material_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Material::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Выбрать материал ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])?>
            <?php echo $form->field($order,'winding_id')->radioList(ArrayHelper::map(Winding::find()->all(),'id', 'name'),[
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value]) ." $value ". Html::img(Winding::findOne($value)->image, ['width'=>'100px']) . '</label>';
                }
            ])?>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <?php echo $form->field($order,'sleeve_id')->dropDownList(ArrayHelper::map(Sleeve::find()->all(), 'id', 'name'))?>
                    <?php echo $form->field($order,'cut_edge')->dropDownList(Enum::boolList())?>
                    <?php echo $form->field($order,'stretch')->dropDownList(Enum::boolList())?>
                </div>
                <div class="col">
                    <?php echo $form->field($order,'plan_circulation')->textInput(['onchange'=>'changeSending()'])?>
                    <?php echo $form->field($order,'sending')?>
                    <?php echo $form->field($order,'label_on_roll')?>
                </div>
            </div>
            <?php echo $form->field($order,'manager_note')->textarea()?>
        </div>
    </div>
	<?php echo Html::submitButton('Создать заказ',['class'=>'btn btn-success'])?>
	<?php ActiveForm::end()?>