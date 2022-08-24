<?php
use yii\bootstrap5\Html;
use app\models\Transport;

?>
<?=Html::tag('h6','Транспорт: ' .Html::encode(Transport::findOne($shipment->transport_id)->name))?>
<?=Html::tag('h6','ГСМ, руб: ' .Html::encode($shipment->gasoline_cost))?>
<?=Html::tag('h6','Командировочные, руб: ' .Html::encode($shipment->cost))?>