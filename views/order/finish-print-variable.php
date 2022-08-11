<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Order;
use app\models\Label;

$this->title = 'Печать закончена';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$order->id.'] '.$order->label->name, 'url' => ['order/view','id'=>$order->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
<?$form = ActiveForm::begin()?>
    <div class="row">
        <div class="col">
            <?=$form->field($label,'variable_paint_count',['inputOptions' =>
                ['autofocus' => 'autofocus','value' => $label->variable_paint_count]
            ])->label('Кол-во краски, мл на 100 эт.:')?>
        </div>
        <div class="col">
        </div>
    </div>
<?=Html::submitButton('Закрыть',['class'=>'btn btn-success'])?>

<?ActiveForm::end()?>