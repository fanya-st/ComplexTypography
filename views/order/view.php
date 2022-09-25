<?php

use yii\bootstrap5\Html;
use kartik\tabs\TabsX;
use app\models\CustomNav;

$this->title = Html::encode("ID [$order->id] $label->name");
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?php echo  Html::encode($this->title)?></h3>
<div class="row">
<?php
echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        'order_params'=>
            [
                'label' => 'Параметры заказа',
                'content'=>$this->render('_order_tab',compact('order')),
                'active'=>true
            ],
        'label_params'=>
            [
                'label' => 'Параметры этикетки',
                'content'=>$this->render('//label/_label_tab',compact('label')),
            ],
        'finished_products_warehouse'=>
            [
                'label' => 'Излишки',
                'content'=>$this->render('//finished-products-warehouse/_finished_products_warehouse_tab',compact('surplus')),
            ],
        [
                'label' => 'ГП',
                'content'=>$this->render('_finished_products',compact('roll')),
            ],
//        [
//                'label' => 'Брак',
//                'content'=>$this->render('//shipment/_defect_tab',compact('roll')),
//            ],
//        'technological_map'=>
//            [
//                'label' => 'Технокарта',
//            ],
            CustomNav::getOrderItemsManager($order),
            CustomNav::getOrderItemsPrinter($order),
            CustomNav::getOrderItemsRewinder($order),
            CustomNav::getOrderItemsPacker($order),
    ],
]);
?>
</div>
<!--<pre>--><?php //print_r($order)?><!--</pre>-->
