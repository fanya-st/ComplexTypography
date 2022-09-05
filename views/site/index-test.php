<?php
use kartik\tabs\TabsX;
use app\models\CustomIndex;

$this->title = Yii::$app->name;
?>
<?


echo TabsX::widget([
    'items'=>CustomIndex::getIndexItems(),
    'position'=>TabsX::POS_ABOVE,
//    'containerOptions'=>['class'=>'bg-secondary'],
    'bordered'=>true,
    'enableStickyTabs'=>true,
    'encodeLabels'=>false,
    'height'=>TabsX::SIZE_X_LARGE,
]);
?>

