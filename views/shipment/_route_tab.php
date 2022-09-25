<?php
use app\models\Order;
use yii\bootstrap5\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use app\models\Customer;

?>
<?php


$gridColumns = [
    'name',
    [
        'attribute'=>'customerAddress',
    ],
    ['label'=>'Коробки и тюки',
        'value'=>function($model){
            $orders=Customer::findOne($model->id)->getCustomerShipmentOrder(Yii::$app->request->get('id'));
//            print_r($request->get('id'));
            if (isset($orders))
                foreach($orders as $order){
                    $rolls=Order::findOne($order)->finishedProductsWarehouse;
                    if(isset($rolls))
                    foreach ($rolls as $roll){
                        $sended_box_count+=$roll->sended_box_count;
                        $sended_bale_count+=$roll->sended_bale_count;
                    }
                }
            return Html::encode('Коробок '.$sended_box_count.' Тюков '.$sended_bale_count);
        }
    ],
    [
        'label'=>'Контакт',
        'value'=>function($model){
            return Html::encode($model->contact.' телефон:'.$model->number);
        },
    ],
    [
        'label'=>'Информация',
        'value'=>function($model){
            return Html::encode('прием продукции происходит с '.$model->time_to_delivery_from.' до '.$model->time_to_delivery_to);
        },
    ],
];

echo ExportMenu::widget([
    'dataProvider' => $route_customers,
    'columns' => $gridColumns,
    'filename' => $shipment->id,
    'showConfirmAlert' => false,
    'clearBuffers' => true,
    'dropdownOptions' => [
        'label' => 'Экспорт',
        'class' => 'btn btn-outline-secondary btn-default'
    ]
]);
echo GridView::widget([
    'dataProvider' => $route_customers,
    'columns' => $gridColumns,
    'exportConfig' => false,
    'export' => false,
    'toolbar' =>false,
    'panel' => [
        'heading' => '<i class="fas fa-map"></i>  Маршрутная карта',
        'type' => 'primary',
    ],
]);
?>
<!--<pre>--><?php //print_r(Customer::findOne(1)->getCustomerShipmentOrder(($shipment->id)))?><!--</pre>-->
<!--<table class="table">-->
<!--    <caption>Маршрутная карта (--><?php //=Html::encode($shipment->managerFullName.' Дата '.$shipment->date_of_send)?><!--)</caption>-->
<!--    <thead>-->
<!--    <tr>-->
<!--        <th scope="col">Заказчик</th>-->
<!--        <th scope="col">Адрес доставки</th>-->
<!--        <th scope="col">Кол-во кор. и тюков</th>-->
<!--        <th scope="col">Контакт</th>-->
<!--        <th scope="col">Информация</th>-->
<!--    </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
<!--    --><?php //
//    if(!empty($shipment->customerOrderList))
//        foreach ($shipment->customerOrderList as $key=>$customer_order):
//    ?>
<!--    <tr>-->
<!--        --><?php //$customer=Customer::findOne($key)?>
<!--        <td>--><?php //=Html::encode($customer->name)?><!--</td>-->
<!--        <td>--><?php //=Html::encode($customer->customerAddress)?><!--</td>-->
<!--        <td>--><?php //
//            foreach ($customer_order as $order){
//                $o=Order::findOne($order);
//            foreach ($o->finishedProductsWarehouse as $roll){
//                $sended_box_count+=$roll->sended_box_count;
//                $sended_bale_count+=$roll->sended_bale_count;
//            }
//            }
//            echo Html::encode('Коробок '.$sended_box_count.' Тюков '.$sended_bale_count);
//            unset($sended_box_count);
//            unset($sended_bale_count);
//            ?>
<!--        </td>-->
<!--        <td>--><?php //=Html::encode($customer->contact.' телефон:'.$customer->number)?><!--</td>-->
<!--        <td>--><?php //=Html::encode('прием продукции происходит с '.$customer->time_to_delivery_from.' до '.$customer->time_to_delivery_to)?><!--</td>-->
<!--    </tr>-->
<!--    --><?php //endforeach;?>
<!--    </tbody>-->
<!--</table>-->

