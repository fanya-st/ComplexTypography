<?php

use yii\bootstrap5\Html;
use kartik\tabs\TabsX;
use app\models\CustomNav;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

$this->title = Html::encode("ID [$order->id] $label->name");
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
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
                'label' => 'Параметры заказа',
                'content'=>$this->render('_order_tab',compact('order')),
            ],
        'label_params'=>
            [
                'label' => 'Параметры этикетки',
                'content'=>$this->render('//label/_label_tab',compact('label')),
            ],
        'technological_map'=>
            [
                'label' => 'Технокарта',
            ],
            CustomNav::getOrderItemsManager($order),
    ],
]);
?>
</div>
