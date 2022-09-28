<?php
use yii\bootstrap5\Html;
use app\models\Transport;

/** @var \app\models\Shipment $shipment */

if(!empty($shipment->transport_id)){
    echo Html::tag('h6','Транспорт: ' .Transport::findOne($shipment->transport_id)->name);
    echo Html::tag('h6','ГСМ, руб: ' .Html::encode($shipment->gasoline_cost));
    echo Html::tag('h6','Командировочные, руб: ' .Html::encode($shipment->cost));
}else
    echo Html::tag('h6','Нет данных');

