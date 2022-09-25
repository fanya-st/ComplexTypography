<?php
use yii\bootstrap5\Html;
use app\models\Transport;

?>
<?php echo Html::tag('h6','Транспорт: ' .Html::encode(Transport::findOne($shipment->transport_id)->name))?>
<?php echo Html::tag('h6','ГСМ, руб: ' .Html::encode($shipment->gasoline_cost))?>
<?php echo Html::tag('h6','Командировочные, руб: ' .Html::encode($shipment->cost))?>