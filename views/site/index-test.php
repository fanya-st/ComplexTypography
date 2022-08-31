<?php
use kartik\tabs\TabsX;
use app\models\CustomIndex;

$this->title = Yii::$app->name;
?>
<?


echo TabsX::widget([
    'items'=>CustomIndex::getIndexItems(),
    'position'=>TabsX::POS_ABOVE,
    'bordered'=>true,
    'enableStickyTabs'=>true,
    'encodeLabels'=>false,
]);
?>

