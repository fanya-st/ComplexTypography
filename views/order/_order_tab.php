<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use app\models\User;

?>
<div class="row g-2 row-cols-lg-2">
    <div class="col-lg">
        <div class="border p-3 rounded" style="background-color:#dee2e6;">
            <div class="row">
                <div class="col">
                    <?php echo  Html::tag('h6','Статус заказа: ' .Html::tag('small',Html::encode($order->orderStatus), ['class' => 'badge bg-primary']));
                    echo Html::tag('h6','Машина: ' .Html::encode($order->mashine->name));
                    echo Html::tag('h6','Менеджер: ' .Html::encode(User::getFullNameById($order->customer->user_id)));
                    echo Html::tag('h6','Заказчик: ' .Html::encode('ID ['.$order->label->customer->id.
                    '] '.$order->label->customer->name));
                    echo Html::tag('h6','Адрес заказчика: ' .Html::encode($order->label->customer->customerAddress));
                    if (isset($order->date_of_sale))echo Html::tag('h6','Дата сдачи: ' . Yii::$app->formatter->asDate(Html::encode($order->date_of_sale), 'yyyy-MM-dd'));?>
                </div>
                <div class="col">
                    <?php
                    echo Html::tag('h6','Материал: ' .Html::encode($order->material->name));
                    echo Html::tag('h6','План. тираж, шт: ' .Html::encode($order->plan_circulation));
                    echo Html::tag('h6','Отправка, шт: ' .Html::encode($order->sending));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="border p-3 rounded" style="background-color:#dee2e6;">
            <h6 class="bg-info p-1 rounded">Параметры печати</h6>
            <h6>Совместная печать: </h6>
                <?php echo  Html::tag('h6','Печатник: ' .Html::encode(User::getFullNameById($order->printer_id)));
                echo Html::tag('h6','Дата начала печати: ' .Html::encode($order->date_of_print_begin));
                echo Html::tag('h6','Дата конца печати: ' .Html::encode($order->date_of_print_end));?>
                <h6>Тираж по печати, шт: <?php echo Html::encode($order->printed_circulation)?>
                    <h6>
                    <?php
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
    <div class="col-lg">
        <div class="border p-3 rounded" style="background-color:#dee2e6;">
            <h6 class="bg-success p-1 rounded">Параметры нарезки и перемотки</h6>
            <?php echo  Html::tag('h6','Перемотчик: ' .Html::encode(User::getFullNameById($order->rewinder_id)));
            echo Html::tag('h6','Дата начала перемотки: ' .Html::encode($order->date_of_rewind_begin));
            echo Html::tag('h6','Дата конца перемотки: ' .Html::encode($order->date_of_rewind_end));?>
            </h6>
            <h6>Перемотанный тираж, шт:
                <?php $rewinded_circulation=null;
//                if (!empty($order->finishedProductsWarehouse))
                foreach ($order->finishedProductsWarehouse as $rewinded_roll)
                    $rewinded_circulation+=$rewinded_roll->label_in_roll*$rewinded_roll->roll_count;
                echo Html::encode($rewinded_circulation);
                ?>
            </h6>
            <h6>
                <?php
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
    <div class="col-lg">
        <div class="border p-3 rounded" style="background-color:#dee2e6;">
            <h6 class="bg-warning p-1 rounded">Параметры упаковки</h6>
            <?php echo  Html::tag('h6','Упаковчик: ' .Html::encode(User::getFullNameById($order->packer_id)));
            echo Html::tag('h6','Дата начала упаковки: ' .Html::encode($order->date_of_packing_begin));
            echo Html::tag('h6','Дата конца упаковки: ' .Html::encode($order->date_of_packing_end));?>
            </h6>
            <h6> Упакованный тираж, шт:
                <?php $packed_circulation=null;
                foreach ($order->finishedProductsWarehouse as $packed_roll){
                    $packed_circulation+=$packed_roll->label_in_roll*$packed_roll->packed_roll_count;
                    $sended_circulation+=$packed_roll->label_in_roll*$packed_roll->sended_roll_count;
                }
                echo Html::encode($packed_circulation);
                ?>
            На отправку, шт: <?php echo Html::encode(!empty($sended_circulation) ? $sended_circulation:0)?>
            </h6>
            <h6>
                <?php
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
                echo 'Коробки:'.Html::encode(!empty($packed_box) ? $packed_box:0).' Тюки:'.Html::encode(!empty($packed_bale) ? $packed_bale:0);
                Modal::end()
                ?>

                <?php
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
                echo 'Коробки:'.Html::encode(!empty($sended_box) ? $sended_box:0).' Тюки:'.Html::encode(!empty($sended_bale) ? $sended_bale:0);
                Modal::end()
                ?></h6>
        </div>
    </div>
</div>

