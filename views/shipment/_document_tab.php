<?php
use yii\bootstrap5\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/** @var \app\models\Order $orders */
/** @var \app\models\Shipment $shipment */

$gridColumns = [
    'customer.name',
    'label.name',
    [
        'attribute'=>'circulationCountSend',
        'label'=>'Тираж на отправку',
    ],

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

