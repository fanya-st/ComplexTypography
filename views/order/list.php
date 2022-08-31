<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use app\models\User;
use app\models\OrderStatus;

$this->title = 'Работа с заказами';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
    <?echo $this->render('_search', ['model' => $searchModel])?>
    <? $form = ActiveForm::begin()?>
<?php //Pjax::begin()?>
    <? echo GridView::widget([
        'dataProvider' => $orders,
        'id'=>'order-list',
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
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
//                'value'=>'orderStatus.name',
                'value' => function($model){return OrderStatus::$order_status[$model->status_id];},
                'filter' => OrderStatus::$order_status,
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center']

            ],
            [
                'label'=>'Статус эт-ки',
                'value'=>'label.labelStatus.name',
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
                    return User::getFullNameByUsername($model->label->customer->manager_login);
                },
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center']

            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
                ],
        ],
    ]);
//    Pjax::end();
    ActiveForm::end()
    ?>
