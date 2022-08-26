<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\grid\GridView;
use kartik\icons\Icon;
Icon::map($this, Icon::FA);

$this->title = 'Нарезка/Перемотка';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$order->id.'] '.$order->label->name, 'url' => ['order/view','id'=>$order->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
<!--<pre>--><?//print_r($new_roll)?><!--</pre>-->
<div class="row g-2 row-cols-2">
    <div class="col">
<div class="border p-3 rounded">
    <div class="row">
        <h6 class="bg-success p-1 rounded">Параметры нарезки и перемотки</h6>
        <div class="col">
            <h6>Была совместная печать заказов: <?foreach ($order->combinatedPrintOrder as $com_ord) echo '<span class="badge rounded-pill bg-primary">'.Html::encode($com_ord->order_id).'</span>'?></h6>
            <h6>Плановый тираж, шт: <?='<span class="badge rounded-pill bg-primary">'.Html::encode($order->plan_circulation).'</span>'?></h6>
            <h6>Этикеток на ролике, шт: <?='<span class="badge rounded-pill bg-primary">'.Html::encode($order->label_on_roll).'</span>'?></h6>
            <h6>Втулка: <?='<span class="badge rounded-pill bg-primary">'.Html::encode($order->sleeve->name).'</span>'?></h6>
            <?if($order->cut_edge==0):?>
                <h6>Срезать кромки: <span class="badge rounded-pill bg-primary">Нет</span></h6>
            <?else:?>
                <h6>Срезать кромки: <span class="badge rounded-pill bg-primary">Да</span></h6>
            <?endif;?>
        </div>
        <div class="col">
            <h6>Тираж по печати, шт: <?='<span class="badge rounded-pill bg-primary">'.Html::encode($order->printed_circulation).'</span>'?></h6>
<!--            <h6>Диаметр ролика: --><?//='<span class="badge rounded-pill bg-primary">'.Html::encode($order->diameter_roll).'</span>'?><!--</h6>-->
            <h6>Намотка: <?= Html::img($order->winding->image, ['alt' => $order->winding->name,'title' => $order->winding->name,'width'=>'100px']) ?></h6>
            <?if($order->stretch==0):?>
                <h6>Стретч лента: <span class="badge rounded-pill bg-primary">Нет</span></h6>
            <?else:?>
                <h6>Стретч лента: <span class="badge rounded-pill bg-primary">Да</span></h6>
            <?endif;?>
        </div>
    </div>
    </div>
</div>
    <div class="col p-2">
        <?echo GridView::widget([
            'dataProvider' => $order_roll,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn',
                    'headerOptions' => ['width' => '20','class'=>'text-wrap']],
                ['attribute'=>'label_in_roll',
                    'headerOptions' => ['width' => '35','class'=>'text-wrap']],
                ['attribute'=>'roll_count',
                    'headerOptions' => ['width' => '35','class'=>'text-wrap']],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{delete}',
                    'headerOptions' => ['width' => '10'],
                    'buttons' => ['delete' => function($url, $model){
                        return Html::a('<span class="fa fa-trash"></span>', ['rewind-delete', 'roll_id' => $model->id], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Вы уверены?',
                                'method' => 'post',
                            ],
                        ]);
                    }],
                ],
            ]
        ])?>
    </div>
        <div class="col p-2">
            <?$form = ActiveForm::begin()?>
            <div class="row">
                <div class="col">
                    <?=$form->field($new_roll,'label_in_roll')?>
                    <?=Html::submitButton('Добавить ролики',['class'=>'btn btn-success'])?>
                </div>
                <div class="col">
                    <?=$form->field($new_roll,'roll_count')?>
                    <?= Html::a('Завершить', ['/order/finish-rewind','id'=>$order->id], ['class'=>'btn btn-success']) ?>
                </div>
            </div>
            <?ActiveForm::end()?>
        </div>
<!--    <pre>--><?//print_r($new_roll)?><!--</pre>-->
    </div>

