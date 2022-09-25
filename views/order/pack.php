<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\icons\Icon;

$this->title = 'Упаковка';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$order->id.'] '.$order->label->name, 'url' => ['order/view','id'=>$order->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo  Html::encode($this->title) ?></h1>
<!--<pre>--><?php //print_r($new_roll)?><!--</pre>-->
<div class="row g-2 row-cols-2">
    <div class="d-flex col">
        <?php $form = ActiveForm::begin()?>
        <table class="table border rounded">
            <thead>
            <tr>
                <th scope="col">Этикеток на ролике</th>
                <th scope="col">Кол-во перемотанных роликов</th>
                <th scope="col">Кол-во упакованных роликов</th>
                <th scope="col">Кол-во упакованных коробок</th>
                <th scope="col">Кол-во упакованных тюков</th>
                <th scope="col">Кол-во упакованных роликов на отправку</th>
                <th scope="col">Кол-во упакованных коробок на отправку</th>
                <th scope="col">Кол-во упакованных тюков на отправку</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order_roll as $id => $roll):?>
                <tr>
                    <td><?php echo Html::encode($roll->label_in_roll)?></td>
                    <td><?php echo Html::encode($roll->roll_count)?></td>
                    <td>
                        <?php
                        echo $form->field($roll,"[$id]packed_roll_count")->label(false);
                        echo Html::submitButton('Упаковать',['class'=>'btn btn-primary']);

                        ?>
                    </td>
                    <td>
                        <?php
                        echo $form->field($roll,"[$id]packed_box_count")->label(false);
                        echo Html::submitButton('Упаковать',['class'=>'btn btn-primary']);

                        ?>
                    </td>
                    <td>
                        <?php
                        echo $form->field($roll,"[$id]packed_bale_count")->label(false);
                        echo Html::submitButton('Упаковать',['class'=>'btn btn-primary']);

                        ?>
                    </td>
                    <td>
                        <?php
                        echo $form->field($roll,"[$id]sended_roll_count")->label(false);
                        echo Html::submitButton('Упаковать',['class'=>'btn btn-primary']);

                        ?>
                    </td>
                    <td>
                        <?php
                        echo $form->field($roll,"[$id]sended_box_count")->label(false);
                        echo Html::submitButton('Упаковать',['class'=>'btn btn-primary']);

                        ?>
                    </td>
                    <td>
                        <?php
                        echo $form->field($roll,"[$id]sended_bale_count")->label(false);
                        echo Html::submitButton('Упаковать',['class'=>'btn btn-primary']);

                        ?>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?php ActiveForm::end()?>
    </div>
</div>
<!--<pre>--><?php //print_r($order)?><!--</pre>-->
<div class=" d-flex col">
<!--            --><?php //=$form->field($order,'bale_count')?>
    <?php echo  Html::a('Завершить упаковку', ['/order/finish-pack','id'=>$order->id], ['class'=>'btn btn-primary']) ?>
<!--            --><?php //=$form->field($order,'box_count')?>
</div>


