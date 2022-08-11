<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Order;
use app\models\Label;

$this->title = 'Совместная печать';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$order->id.'] '.$order->label->name, 'url' => ['order/view','id'=>$order->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?$form = ActiveForm::begin()?>
<!--<pre>--><?//print_r($com_temp)?><!--</pre>-->
<div class="row">
    <div class="col">
        <?=$form->field($com_temp,'order_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Order::find()->andWhere(['label_id'=>Label::findOne($order->label_id)
                ->combinatedLabel])
                ->andWhere(['!=', 'id',$order->id])
                ->andWhere(['status_id'=>1])->all(),
                'id', 'labelNameSplitOrderId'),
            'options' => ['placeholder' => 'Заказы для совмещения ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true
            ],
        ])->label('Заказы доступные для совместной печати:')?>
    </div>
    <div class="col">
    </div>
</div>
<?=Html::submitButton('Совместить',['class'=>'btn btn-success'])?>

<?ActiveForm::end()?>