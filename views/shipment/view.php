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
<!--<pre>--><?//print_r($shipment->finishedProductsWarehouse)?><!--</pre>-->
<div class="row">
    <?
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
                    'content'=>$this->render('_defect_tab',compact('shipment','shipment_roll')),
                ],
        ],
    ]);
    ?>
</div>

