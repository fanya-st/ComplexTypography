<?php

use yii\bootstrap5\Html;

?>
<div class="row">
    <div class="col p-2">
        <?
        echo Html::tag('h6','Статус заказа: ' .Html::tag('small',Html::encode($order->orderStatusName), ['class' => 'badge bg-primary']));
        echo Html::tag('h6','Машина: ' .Html::encode($order->mashine->name));
        echo Html::tag('h6','Заказчик: ' .Html::encode('ID ['.$order->label->customer->id.
                '] '.$order->label->customer->name));
        echo Html::tag('h6','Адрес заказчика: ' .Html::encode($order->label->customer->address_id));
        echo Html::tag('h6','Дата сдачи: ' .Html::encode($order->date_of_sale));
        echo Html::tag('h6','Материал: ' .Html::encode($order->material->name));
        echo Html::tag('h6','План. тираж, шт: ' .Html::encode($order->plan_circulation));
        echo Html::tag('h6','Факт. тираж, шт: ' .Html::encode($order->actual_circulation));

        ?>
    </div>
    <div class="col p-2">
        <?
        echo Html::tag('h6','Дата начала печати: ' .Html::encode($order->date_of_print_begin));
        echo Html::tag('h6','Дата конца печати: ' .Html::encode($order->date_of_print_end));
        echo Html::tag('h6','Дата начала нарезки: ' .Html::encode($order->date_of_cut_begin));
        echo Html::tag('h6','Дата конца нарезки: ' .Html::encode($order->date_of_cut_end));
        echo Html::tag('h6','Дата начала перемотки: ' .Html::encode($order->date_of_rewind_begin));
        echo Html::tag('h6','Дата конца перемотки: ' .Html::encode($order->date_of_rewind_end));
        echo Html::tag('h6','Дата начала упаковки: ' .Html::encode($order->date_of_packing_begin));
        echo Html::tag('h6','Дата конца упаковки: ' .Html::encode($order->date_of_packing_end));
        ?>
<!--        <pre>--><?// print_r($order)?><!--</pre>-->
    </div>
    <div class="col border p-2 rounded">
        <h6>Параметры печати:</h6>
    </div>
</div>


