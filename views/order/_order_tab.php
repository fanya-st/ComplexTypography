<?php

use yii\bootstrap5\Html;

?>
<div class="row g-3 row-cols-3">
    <div class="col">
        <div class="border p-3 rounded">
            <div class="row g-1 row-cols-2">
                <div class="col">
                    <? echo Html::tag('h6','Статус заказа: ' .Html::tag('small',Html::encode($order->orderStatusName), ['class' => 'badge bg-primary']));
                    echo Html::tag('h6','Машина: ' .Html::encode($order->mashine->name));
                    echo Html::tag('h6','Менеджер: ' .Html::encode($order->fullName));
                    echo Html::tag('h6','Заказчик: ' .Html::encode('ID ['.$order->label->customer->id.
                    '] '.$order->label->customer->name));
                    echo Html::tag('h6','Адрес заказчика: ' .Html::encode($order->label->customer->address_id));?>
                </div>
                <div class="col">
                    <?
                    echo Html::tag('h6','Дата сдачи: ' .Html::encode($order->date_of_sale));
                    echo Html::tag('h6','Материал: ' .Html::encode($order->material->name));
                    echo Html::tag('h6','План. тираж, шт: ' .Html::encode($order->plan_circulation));
                    echo Html::tag('h6','Отправка, шт: ' .Html::encode($order->sending));
                    echo Html::tag('h6','Пробный тираж: ' .Html::encode($order->trialCirculationName));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="border p-3 rounded" style="background-color:#dee2e6;">
            <h6 class="bg-info p-1 rounded">Параметры печати</h6>
            <h6>Совместная печать: <?foreach ($order->combinatedPrintOrder as $com_ord) echo '<span class="badge rounded-pill bg-primary">'.Html::encode($com_ord->order_id).'</span>'?>
                <? echo Html::tag('h6','Печатник: ' .Html::encode($order->printerName));
                echo Html::tag('h6','Дата начала печати: ' .Html::encode($order->date_of_print_begin));
                echo Html::tag('h6','Дата конца печати: ' .Html::encode($order->date_of_print_end));?>
                <h6>Факт. тираж, шт: <?=Html::encode($order->actual_circulation)?>
                </h6>
        </div>
    </div>
    <div class="col">
        <div class="border p-3 rounded" style="background-color:#dee2e6;">
            <h6 class="bg-info p-1 rounded">Параметры нарезки</h6>
            <? echo Html::tag('h6','Нарезчик: ' .Html::encode($order->cutterName));
            echo Html::tag('h6','Дата начала нарезки: ' .Html::encode($order->date_of_cut_begin));
            echo Html::tag('h6','Дата конца нарезки: ' .Html::encode($order->date_of_cut_end));?>
            </h6>
        </div>
    </div>
    <div class="col">
        <div class="border p-3 rounded" style="background-color:#dee2e6;">
            <h6 class="bg-info p-1 rounded">Параметры перемотки</h6>
            <? echo Html::tag('h6','Перемотчик: ' .Html::encode($order->rewinderName));
            echo Html::tag('h6','Дата начала перемотки: ' .Html::encode($order->date_of_rewind_begin));
            echo Html::tag('h6','Дата конца перемотки: ' .Html::encode($order->date_of_rewind_end));?>
            </h6>
        </div>
    </div>
    <div class="col">
        <div class="border p-3 rounded" style="background-color:#dee2e6;">
            <h6 class="bg-info p-1 rounded">Параметры упаковки</h6>
            <? echo Html::tag('h6','Упаковчик: ' .Html::encode($order->packerName));
            echo Html::tag('h6','Дата начала упаковки: ' .Html::encode($order->date_of_packing_begin));
            echo Html::tag('h6','Дата конца упаковки: ' .Html::encode($order->date_of_packing_end));?>
            </h6>
        </div>
    </div>
</div>

