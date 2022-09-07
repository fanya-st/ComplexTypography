<?php
use yii\bootstrap5\Html;
use kartik\icons\Icon;
use yii\web\View;
use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;



$this->title = Html::encode('Печать ярлыков ID ['.$order->id.'] '.$order->label->name);
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$order->id.'] '.$order->label->name, 'url' => ['order/view','id'=>$order->id]];

$this->registerJs(
    "
function printDiv(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
function changeSummary(){
    document.getElementById('summary').value=document.getElementById('label_in_roll').value*document.getElementById('count_roll').value;
    document.getElementById('summary2').value=document.getElementById('label_in_roll2').value*document.getElementById('count_roll2').value;
    }    
    
    ",
    View::POS_HEAD,
    'print'
);

?>
<div class="row g-2 row-cols-3">
        <?php $form = ActiveForm::begin()?>
        <div id='box-label' class="col p-1 rounded">
            <?=html::tag('p',Yii::$app->params['company_full_name'].' т/ф '.Yii::$app->params['company_number'],['class'=>'fw-bold'])?>
            <?=html::tag('p','Заказчик: '.$order->label->customer->name,['class'=>'fw-bold'])?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col" style="width:75px;">Наименование</th>
                    <th scope="col" style="width:50px;">кол.рол.</th>
                    <th scope="col" style="width:75px;">кол-во эт. в рол.</th>
                </tr>
                </thead>
                <tbody>
                <?foreach ($finished_products as $index =>$finished_product):?>
                <tr>
                    <td><?=$order->label->name?></td>
                    <td><?=$form->field($finished_product, "[$index]packed_roll_count")->textInput(['id'=>'count_roll','onchange'=>'changeSummary()','value'=>$finished_product->packed_roll_count])->label(false)?></td>
                    <td><?=$form->field($finished_product, "[$index]label_in_roll")->textInput(['id'=>'label_in_roll','value'=>$finished_product->label_in_roll])->label(false)?></td>
                </tr>
                <?endforeach;?>
                </tbody>
            </table>
            <?=$form->field($order, 'packer_id')->dropDownList(User::findUsersByGroup('packer'),[
                    'prompt' => 'Все',
                'onchange'=>'changeSummary()',
                'disabled'=>true
                ])->label('Упаковщик:')?>
        </div>
        <div class="col p-2">
            <?=Html::submitButton('Печать ярлыка',['name'=>'print_box_label','class'=>'btn btn-success'])?>
        </div>
    </div>
    <?php ActiveForm::end()?>





