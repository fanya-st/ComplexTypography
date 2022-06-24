<?php

use yii\bootstrap5\Html;
use kartik\tabs\TabsX;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

$this->title = Html::encode("Отгрузка ID [$shipment->id]");
$this->params['breadcrumbs'][] = ['label' => 'Работа с отгрузками', 'url' => ['shipment/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= Html::encode($this->title)?></h3>
<div class="row">
    <?
    echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'items' => [
            'order_params'=>
                [
                    'label' => 'Параметры отгрузки',
                    'content'=>$this->render('_shipment_tab',compact('shipment','orders')),
                    'active'=>true
                ],
            [
                    'label' => 'Маршрут',
                    'content'=>$this->render('_route_tab',compact('shipment','route_customers')),
                ],
            [
                    'label' => 'Документы',
                    'content'=>$this->render('_document_tab',compact('shipment','orders')),
                ],
//            [
//                    'label' => 'Добавить заказы',
//                    'content'=>$this->render('_order_add_tab',compact('add_order','searchModel')),
//                'active'=>false
//                ],
        ],
    ]);
    ?>
</div>

