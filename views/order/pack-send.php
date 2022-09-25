<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Упаковка (на отправку)';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$order->id.'] '.$order->label->name, 'url' => ['order/view','id'=>$order->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo  Html::encode($this->title) ?></h1>
<div class="row g-2 row-cols-2">
    <div class="d-flex col">
        <?php $form = ActiveForm::begin()?>
        <table class="table border rounded">
            <thead>
            <tr>
                <th scope="col">Этикеток на ролике</th>
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
                    <td><?php echo Html::encode($roll->packed_roll_count)?></td>
                    <td><?php echo Html::encode($roll->packed_box_count)?></td>
                    <td><?php echo Html::encode($roll->packed_bale_count)?></td>
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


