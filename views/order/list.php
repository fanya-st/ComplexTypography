<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;

$this->title = 'Работа с заказами';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
    <?echo $this->render('_search', ['model' => $searchModel])?>
    <? $form = ActiveForm::begin(['action'=>['order/selected-order-process']])?>
<div class="col p-2">
    <?=Html::submitButton('Совместная печать',['name'=>'combinated-print', 'value' => 'combinated-print','class'=>'btn btn-info'])?>
    <?=Html::submitButton('Отменить совместную печать',['name'=>'combinated-print-unset', 'value' => 'combinated-print-unset','class'=>'btn btn-info'])?>
</div>
    <? echo GridView::widget([
        'dataProvider' => $orders,
        'id'=>'order-list',
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            'id',
            [
                'label' => 'ID Эт-ки',
                'attribute' => 'label.id',
            ],
            [
                'label' => 'Наименование',
                'attribute' => 'labelName',
                'contentOptions'=>function($model, $key, $index, $column) {
                    if(isset($model->combinationOrder))
                        return ['class' => 'bg-info','title'=>$model->combinatedPrintOrderName];
                    else
                        return ['style' => ''];
                 }
                ],
            'date_of_create',
            'orderStatusName',
            'labelStatusName',
            'mashineName',
            'fullName',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
                ],
        ],
    ]);
    ActiveForm::end()
    ?>
