<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\bootstrap5\Modal;
Icon::map($this, Icon::FA);

$this->title = 'Упаковка';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$order->id.'] '.$order->label->name, 'url' => ['order/view','id'=>$order->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<!--<pre>--><?//print_r($new_roll)?><!--</pre>-->
<div class="row g-2 row-cols-2">
    <div class="d-flex col">
        <? $form = ActiveForm::begin()?>
        <table class="table border rounded">
            <thead>
            <tr>
                <th scope="col">Этикеток на ролике</th>
                <th scope="col">Кол-во перемотанных роликов</th>
                <th scope="col">Кол-во упакованных роликов</th>
            </tr>
            </thead>
            <tbody>
            <?foreach ($order_roll as $id => $roll):?>
                <tr>
                    <td><?=Html::encode($roll->label_in_roll)?></td>
                    <td><?=Html::encode($roll->count)?></td>
                    <td>
                        <?
                        echo $form->field($roll,"[$id]packed_count")->label(false);
                        echo Html::submitButton('Упаковать',['class'=>'btn btn-primary']);

                        ?>
                    </td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
        <? ActiveForm::end()?>
    </div>
</div>
<?$form = ActiveForm::begin()?>
<pre><?print_r($order)?></pre>
<div class=" d-flex col">
    <div class="row">
        <div class="col">
            <?=$form->field($order,'bale_count')?>
            <?=Html::submitButton('Завершить упаковку',['class'=>'btn btn-primary'])?>
        </div>
        <div class="col">
            <?=$form->field($order,'box_count')?>
        </div>
    </div>
</div>
<?ActiveForm::end()?>


