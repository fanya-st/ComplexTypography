<?php

use app\models\Form;
use app\models\MashinePantone;
use app\models\OrderMaterial;
use app\models\Pantone;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\View;
use app\models\Order;
use app\models\Customer;
use app\models\Mashine;
use app\models\Pants;
use app\models\Label;
use kartik\select2\Select2;
use kartik\datetime\DateTimePicker;

$this->title = Html::encode('Финансовый отчет');
$this->params['breadcrumbs'][] = $this->title;

?>
<h3><?= Html::encode($this->title)?></h3>

<?$form=ActiveForm::begin()?>
<?=$form->field($searchModel,'date_of_print_start')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Введите начало периода ...'],
    'pluginOptions' => [
        'todayBtn' => true,
        'autoclose' => true
    ]
])?>

<?=$form->field($searchModel,'date_of_print_end')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Введите конец периода ...'],
    'pluginOptions' => [
        'todayBtn' => true,
        'autoclose' => true
    ]
])?>

<?=$form->field($searchModel,'label_id')->widget(Select2::class, [
    'data' => ArrayHelper::map(Label::find()->all(), 'id', 'nameSplitId'),
    'options'=>[
        'placeholder' => ' Выберите этикетку ...',
    ],
    'pluginOptions' => [
        'allowClear' => true
    ],
])?>

<?=$form->field($searchModel,'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->asArray()->all(),'id','name'),['prompt'=>''])?>

<?=$form->field($searchModel,'customer_id')->widget(Select2::class, [
    'data' => ArrayHelper::map(Customer::find()->asArray()->all(), 'id', 'name'),
    'options'=>[
        'placeholder' => ' Выберите заказчика ...',
    ],
    'pluginOptions' => [
        'allowClear' => true
    ],
])?>


<?=$form->field($searchModel,'pants_id')->widget(Select2::class, [
    'data' => ArrayHelper::map(Pants::find()->asArray()->all(), 'id', 'name'),
    'options'=>[
        'placeholder' => ' Выберите штанец ...',
    ],
    'pluginOptions' => [
        'allowClear' => true
    ],
])?>


<?=$form->field($searchModel,'enterprise_cost')->checkbox()?>

<?=html::submitButton('Показать',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>

<!--<pre>--><?//print_r(OrderMaterial::find()->joinWith('paperWarehouse')->select(['paper_warehouse.material_id'])
//        ->andWhere(['order_material.order_id' => 31])->column())?><!--</pre>-->

<!--<pre>--><?//print_r(Pantone::find()->select('price_euro')->where(['pantone_kind_id'=>[1,2],'id'=>
//        MashinePantone::find()->joinWith('mashine')
//            ->select('mashine_pantone.pantone_id')
//            ->andwhere(['mashine.mashine_type'=>2])->column()])
//        ->average('price_euro'))?><!--</pre>-->
<!--<pre>--><?//print_r(Order::findOne(1)->shipment)?><!--</pre>-->
<pre><?print_r($orders)?></pre>
