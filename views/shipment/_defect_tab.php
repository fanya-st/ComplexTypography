<?php
use yii\bootstrap5\Html;
?>
<div class="d-flex col">
        <div class="table-responsive">
        <table class="table border rounded">
            <thead>
            <tr>
                <th scope="col">ID заказа</th>
                <th scope="col">Наименование</th>
                <th scope="col">Этикеток в ролике</th>
                <th scope="col">Кол-во упакованных роликов на отправку</th>
                <th scope="col">Количество возращенных/дефектных роликов</th>
                <th scope="col">Примечание</th>
            </tr>
            </thead>
            <tbody>
            <?foreach ($roll as $one_roll):?>
                <tr <? if ($one_roll->defect_roll_count>0)echo 'class="table-danger"'?>>
                    <td><?=Html::encode($one_roll->order_id)?></td>
                    <td><?=Html::encode($one_roll->label->name)?></td>
                    <td><?=Html::encode($one_roll->label_in_roll)?></td>
                    <td><?=Html::encode($one_roll->sended_roll_count)?></td>
                    <td><?=Html::encode($one_roll->defect_roll_count)?></td>
                    <td><?=Html::encode($one_roll->defect_note)?></td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
        </div>
    </div>
