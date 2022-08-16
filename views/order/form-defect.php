<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\FormDefect;

$this->title = 'Брак форм';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$order->id.'] '.$order->labelName, 'url' => ['order/view','id'=>$order->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<!--<pre>--><?//print_r($order->combinatedPrintOrder)?><!--</pre>-->
<!--<pre>--><?//print_r($form_temp)?><!--</pre>-->
<?
$form=ActiveForm::begin();
echo GridView::widget([
    'dataProvider' => $forms,
    'columns' => [
        [
            'class' => 'yii\grid\CheckboxColumn',
            // вы можете настроить дополнительные свойства здесь.
        ],
        'id',
        'pantone.name',
        'formDefect.name',
        'width',
        'height',
        'dpi',
        'photoOutput.name'
    ]
]);
echo $form->field($form_temp,'form_defect_id_temp')->dropDownList(ArrayHelper::map(FormDefect::find()->all(),'id','name'))->label('Вид брака');
echo Html::submitButton('В брак',['class'=>'btn btn-success']);
ActiveForm::end();
?>
