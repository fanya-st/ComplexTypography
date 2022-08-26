<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Печать закончена';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$order->id.'] '.$order->label->name, 'url' => ['order/view','id'=>$order->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
<?$form = ActiveForm::begin()?>
<!--    <pre>--><?//print_r($order)?><!--</pre>-->
    <div class="row">
        <div class="col">
            <?=$form->field($order,'printed_circulation',['inputOptions' =>
                ['autofocus' => 'autofocus','value' => $order->plan_circulation]
            ])->label('Введите получившийся после печати тираж:')?>
        </div>
        <div class="col">
        </div>
    </div>
<?=Html::submitButton('Закрыть',['class'=>'btn btn-success'])?>

<?ActiveForm::end()?>