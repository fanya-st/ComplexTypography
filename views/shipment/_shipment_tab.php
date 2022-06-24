<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
?>
<div class="row g-2 row-cols-2">
    <div class="col">
        <?=Html::tag('h6','Менеджер: ' .Html::encode($shipment->managerFullName))?>
        <?switch ($shipment->status_id){
            case 0:
                echo Html::tag('h6','Статус: Новая отгрузка');
                break;
            case 1:
                echo Html::tag('h6','Статус: Отправлено');
                break;
            case 2:
                echo Html::tag('h6','Статус: Завершено');
                break;
        }?>
        <?=Html::tag('h6','Дата отправки: ' .Html::encode($shipment->date_of_send))?>
        <?=Html::tag('h6','Вес, кг: ' .Html::encode($shipment->shipmentWeight))?>
<!--        <pre>--><?//print_r('')?><!--</pre>-->
        <?= Html::a('Добавить заказы', ['shipment/order-add','id'=>$shipment->id], ['class'=>'btn btn-primary']) ?>
        <?= Html::a('Отправить', ['shipment/send-shipment','id'=>$shipment->id], ['class'=>'btn btn-primary']) ?>
    </div>
</div>
<?php
echo GridView::widget([
    'dataProvider' => $orders,
    'columns' => [
            [
                    'attribute'=>'id',
                'label'=>'ID'
            ],
            'labelName',
            'customer.name',
            'customer.customerAddress',
            'orderStatus.name',
            'mashine.name',
            'plan_circulation',
            'circulationCountSend',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{delete}'
        ],
    ],
]);
?>