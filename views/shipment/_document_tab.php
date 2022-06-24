<?php
use app\models\Order;
use yii\bootstrap5\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

?>
<?php

$gridColumns = [
    'customer.name',
    'labelName',
    'circulationCountSend',
    [
        'label'=>'Цена без НДС',
        'value'=>function($model){
            return Html::encode($model->circulationCountSend*$model->label_price);
        },
    ],
    [
        'label'=>'Цена c НДС',
        'value'=>function($model){
            return Html::encode($model->circulationCountSend*$model->label_price_with_tax);
        },
    ],
];

echo ExportMenu::widget([
    'dataProvider' => $orders,
    'columns' => $gridColumns,
    'filename' => $shipment->id,
    'showConfirmAlert' => false,
    'clearBuffers' => true,
    'dropdownOptions' => [
        'label' => 'Экспорт',
        'class' => 'btn btn-outline-secondary btn-default'
    ]
]);
echo GridView::widget([
    'dataProvider' => $orders,
    'columns' => $gridColumns,
    'exportConfig' => false,
    'export' => false,
    'toolbar' =>false,
    'panel' => [
        'heading' => '<i class="fas fa-list"></i>  Документы',
        'type' => 'primary',
    ],
]);
?>

