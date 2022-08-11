<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use app\models\User;

?>
<div class="row g-2 row-cols-2">
    <div class="col">
        <div class="border p-3 rounded" style="background-color:#dee2e6;">
            <div class="row">
                <div class="col">
                    <? echo Html::tag('h6','Статус заказа: ' .Html::tag('small',Html::encode($order->orderStatus->name), ['class' => 'badge bg-primary']));
                    echo Html::tag('h6','Машина: ' .Html::encode($order->mashine->name));
                    echo Html::tag('h6','Менеджер: ' .Html::encode(User::getFullNameByUsername($order->customer->manager_login)));
                    echo Html::tag('h6','Заказчик: ' .Html::encode('ID ['.$order->label->customer->id.
                    '] '.$order->label->customer->name));
                    echo Html::tag('h6','Адрес заказчика: ' .Html::encode($order->label->customer->customerAddress));
                    if (isset($order->date_of_sale))echo Html::tag('h6','Дата сдачи: ' . Yii::$app->formatter->asDate(Html::encode($order->date_of_sale), 'yyyy-MM-dd'));?>
                </div>
                <div class="col">
                    <?
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
<!--            --><?//if ($order->status_id==3) echo Html::tag('h6','Печать приостановлена',['class'=>'bg-warning p-1 rounded'])?>
            <h6>Совместная печать: <?foreach ($order->combinatedPrintOrder as $com_ord) echo '<span class="badge rounded-pill bg-primary">'.Html::encode($com_ord->order_id).'</span>'?></h6>
                <? echo Html::tag('h6','Печатник: ' .Html::encode(User::getFullNameByUsername($order->printer_login)));
                echo Html::tag('h6','Дата начала печати: ' .Html::encode($order->date_of_print_begin));
                echo Html::tag('h6','Дата конца печати: ' .Html::encode($order->date_of_print_end));?>
                <h6>Факт. тираж, шт: <?=Html::encode($order->actual_circulation)?>
                    <h6>
                    <?
                    Modal::begin([
                        'title' => 'Расход материала',
                        'toggleButton' => ['label' => 'Расход материала', 'class' => 'btn btn-info'],
                        'centerVertical'=>true,
                    ]);
                    echo Html::ul($order->orderMaterialList, ['item' => function ($item, $index) {
                        return Html::tag(
                            'li',Html::encode($item->paperWarehouse->material->name.' Ширина: '.$item->paperWarehouse->width.'мм Длина:'.$item->length.'м')
                        );
                    }]);
                    Modal::end()
                    ?></h6>
                </h6>
        </div>
    </div>
<!--    <div class="col">-->
<!--        <div class="border p-3 rounded" style="background-color:#dee2e6;">-->
<!--            <h6 class="bg-primary p-1 rounded">Параметры нарезки</h6>-->
<!--            --><?// echo Html::tag('h6','Нарезчик: ' .Html::encode($order->cutterName));
//            echo Html::tag('h6','Дата начала нарезки: ' .Html::encode($order->date_of_cut_begin));
//            echo Html::tag('h6','Дата конца нарезки: ' .Html::encode($order->date_of_cut_end));?>
<!--            </h6>-->
<!--        </div>-->
<!--    </div>-->
    <div class="col">
        <div class="border p-3 rounded" style="background-color:#dee2e6;">
            <h6 class="bg-success p-1 rounded">Параметры нарезки и перемотки</h6>
            <? echo Html::tag('h6','Перемотчик: ' .Html::encode(User::getFullNameByUsername($order->rewinder_login)));
            echo Html::tag('h6','Дата начала перемотки: ' .Html::encode($order->date_of_rewind_begin));
            echo Html::tag('h6','Дата конца перемотки: ' .Html::encode($order->date_of_rewind_end));?>
            </h6>
            <h6>Перемотанный тираж, шт:
                <? $rewinded_circulation=null;
                foreach ($order->finishedProductsWarehouse as $rewinded_roll)
                    $rewinded_circulation+=$rewinded_roll->label_in_roll*$rewinded_roll->roll_count;
                echo Html::encode($rewinded_circulation);
                ?>
            </h6>
            <h6>
                <?
                Modal::begin([
                    'title' => 'Перемотанные ролики',
                    'toggleButton' => ['label' => 'Перемотанные ролики', 'class' => 'btn btn-success'],
                    'centerVertical'=>true,
                ]);
                echo Html::ul($order->finishedProductsWarehouse, ['item' => function ($item, $index) {
                    if ($item->roll_count!=null OR $item->roll_count!=0)
                    return Html::tag(
                        'li',Html::encode(' Этикеток на ролике: '.$item->label_in_roll.'шт Кол-во роликов:'.$item->roll_count.' шт')
                    );
                }]);
                Modal::end()
                ?></h6>
        </div>
    </div>
    <div class="col">
        <div class="border p-3 rounded" style="background-color:#dee2e6;">
            <h6 class="bg-warning p-1 rounded">Параметры упаковки</h6>
            <? echo Html::tag('h6','Упаковчик: ' .Html::encode(User::getFullNameByUsername($order->packer_login)));
            echo Html::tag('h6','Дата начала упаковки: ' .Html::encode($order->date_of_packing_begin));
            echo Html::tag('h6','Дата конца упаковки: ' .Html::encode($order->date_of_packing_end));?>
            </h6>
            <h6> Упакованный тираж, шт:
                <? $packed_circulation=null;
                foreach ($order->finishedProductsWarehouse as $packed_roll)
                    $packed_circulation+=$packed_roll->label_in_roll*$packed_roll->packed_roll_count;
                echo Html::encode($packed_circulation);
                ?>
            Излишки, шт: <?=Html::encode($rewinded_circulation-$packed_circulation)?>
            </h6>
            <h6>
                <?
                Modal::begin([
                    'title' => 'Упакованные ролики',
                    'toggleButton' => ['label' => 'Упакованные ролики', 'class' => 'btn btn-warning'],
                    'centerVertical'=>true,
                ]);
                echo Html::ul($order->finishedProductsWarehouse, ['item' => function ($item, $index) {
                    if ($item->packed_roll_count!=null OR $item->packed_roll_count!=0)
                    return Html::tag(
                        'li',Html::encode(' Этикеток на ролике: '.$item->label_in_roll.'шт Кол-во роликов:'.$item->packed_roll_count.' шт')
                    );
                }]);
                foreach ($order->finishedProductsWarehouse as $packed_roll){
                    $packed_box += $packed_roll->packed_box_count;
                    $packed_bale += $packed_roll->packed_bale_count;
                }
                echo 'Коробки:'.Html::encode($packed_box).' Тюки:'.Html::encode($packed_bale);
                Modal::end()
                ?>

                <?
                Modal::begin([
                    'title' => 'Упакованные ролики на отправку',
                    'toggleButton' => ['label' => 'Упакованные ролики на отправку', 'class' => 'btn btn-warning'],
                    'centerVertical'=>true,
                ]);
                echo Html::ul($order->finishedProductsWarehouse, ['item' => function ($item, $index) {
                    if ($item->sended_roll_count!=null OR $item->sended_roll_count!=0)
                    return Html::tag(
                        'li',Html::encode(' Этикеток на ролике: '.$item->label_in_roll.'шт Кол-во роликов:'.$item->sended_roll_count.' шт')
                    );
                }]);
                foreach ($order->finishedProductsWarehouse as $sended_roll){
                    $sended_box += $sended_roll->sended_box_count;
                    $sended_bale += $sended_roll->sended_bale_count;
                }
                echo 'Коробки:'.Html::encode($sended_box).' Тюки:'.Html::encode($sended_bale);
                Modal::end()
                ?></h6>
        </div>
    </div>
</div>

