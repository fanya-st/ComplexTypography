<?php

use yii\bootstrap5\Html;
use kartik\tabs\TabsX;

/** @var \app\models\Shipment $shipment */
$this->title = Html::encode("Отгрузка ID [$shipment->id]");
$this->params['breadcrumbs'][] = ['label' => 'Работа с отгрузками', 'url' => ['shipment/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?php echo  Html::encode($this->title)?></h3>
<div class="row">
    <?php
    echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'items' => [
            'shipment_params'=>
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
            [
                    'label' => 'Брак',
                    'content'=>$this->render('_defect_tab',compact('roll')),
                ],
            [
                    'label' => 'Транспортировка',
                    'content'=>$this->render('_transport_tab',compact('shipment')),
                ],
        ],
    ]);
    ?>
</div>

