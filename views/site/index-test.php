<?php
use kartik\tabs\TabsX;

$this->title = Yii::$app->name;
?>
<?


echo TabsX::widget([
    'items'=>\app\models\CustomIndex::getIndexItems(),
    'position'=>TabsX::POS_ABOVE,
    'bordered'=>true,
    'encodeLabels'=>false
]);
?>

