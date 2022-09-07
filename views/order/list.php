<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use app\models\User;
use app\models\OrderStatus;
use app\models\LabelStatus;
use kartik\icons\Icon;

$this->title = 'Работа с заказами';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
    <?echo $this->render('_search', ['model' => $searchModel])?>
<div class="table-responsive">
    <? $form = ActiveForm::begin()?>
    <? echo GridView::widget([
        'dataProvider' => $orders,
        'columns' => [
            [
                'attribute' => 'id',
                'label' => 'ID',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center','style' => 'width:5%'],
            ],
            [
                'attribute' => 'label_id',
                'label' => 'ID Эт-ки',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center','style' => 'width:5%'],
            ],
            [
                'label' => 'Наименование',
                'attribute' => 'label.name',
                'contentOptions'=>function($model, $key, $index, $column) {
                    if(isset($model->combinationOrder))
                        return ['class' => 'bg-info','title'=>$model->combinatedPrintOrderName];
                    else
                        return ['style' => ''];
                 }
                ],
            'date_of_create',
            [
                'attribute'=>'status_id',
                'value' => function($model){return OrderStatus::$order_status[$model->status_id];},
                'filter' => OrderStatus::$order_status,
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center']

            ],
            [
                'label'=>'Статус эт-ки',
                'value'=>function($model){
                    return LabelStatus::$label_status[$model->label->status_id];
                },
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center']

            ],
            [
                'attribute'=>'mashine_id',
                'value'=>'mashine.name',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center']

            ],
            [
                'label'=>'Менеджер',
                'value'=>function($model){
                    return User::getFullNameById($model->label->customer->user_id);
                },
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center']

            ],
//            ['class' => 'yii\grid\ActionColumn',
//                'template' => '{view}'
//                ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('eye', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['order/view', 'id' => $model->id], ['class' => 'profile-link']);
                    }
                ]
            ],
        ],
    ]);
    ActiveForm::end()
    ?>
</div>
