<?php
use yii\bootstrap5\Html;
use app\models\User;
use yii\grid\GridView;

/** @var \app\models\Shipment $shipment */
/** @var \yii\data\ActiveDataProvider $orders */
?>
<div class="row g-2 row-cols-2">
    <div class="col">
        <?php echo Html::tag('h6','Менеджер: ' .Html::encode(User::getFullNameById($shipment->manager_id)))?>
        <?php switch ($shipment->status_id){
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
        <?php echo Html::tag('h6','Дата отправки: ' .Html::encode($shipment->date_of_send))?>
        <?php echo Html::tag('h6','Вес, кг: ' .Html::encode($shipment->shipmentWeight))?>
        <div class="text-nowrap d-lg-inline-flex">
        <?php switch ($shipment->status_id){
            case 0:
                echo Html::tag('div',Html::a('Добавить заказы', ['shipment/order-add', 'id' => $shipment->id], ['class' => 'btn btn-primary']),['class'=>'p-1']);
                echo Html::tag('div',Html::a('Отправить', ['shipment/send-shipment','id'=>$shipment->id], ['class'=>'btn btn-primary']),['class'=>'p-1']);
                break;
            case 1:
                echo Html::tag('div',Html::a('Закрыть', ['shipment/close-shipment','id'=>$shipment->id], ['class'=>'btn btn-primary']),['class'=>'p-1']);
                break;
        }?>
            <?php echo Html::tag('div',Html::a('Пометить брак', ['shipment/mark-defect-roll','id'=>$shipment->id], ['class'=>'btn btn-primary']),['class'=>'p-1']);?>
            <?php echo Html::tag('div',Html::a('Внести данные поездки', ['shipment/edit-transport','id'=>$shipment->id], ['class'=>'btn btn-primary']),['class'=>'p-1']);?>
            </div>
    </div>
</div>
<div class="table-responsive">
<?php
echo GridView::widget([
    'dataProvider' => $orders,
    'columns' => [
            [
                    'attribute'=>'id',
                'label'=>'ID'
            ],
            'label.name',
            'customer.name',
            'customer.customerAddress',
        [
            'attribute'=>'order.status_id',
            'label'=>'Статус заказа'
        ],

            'mashine.name',
            'plan_circulation',
        [
            'attribute'=>'circulationCountSend',
            'label'=>'Тираж на отправку',
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{delete}'
        ],
    ],
]);
?>
</div>
