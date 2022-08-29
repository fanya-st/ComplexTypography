<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\OrderStatus;
use app\models\LabelStatus;
use app\models\Mashine;
use app\models\User;
use kartik\icons\Icon;
Icon::map($this, Icon::FA);

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<? $form = ActiveForm::begin()?>
<? echo GridView::widget([
    'dataProvider' => $orders,
    'filterModel' => $searchModel,
    'id'=>'order-list',
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
            'attribute' => 'labelName',
            'headerOptions' => ['class' => 'text-center','style' => 'width:20%'],
            'contentOptions'=>function($model, $key, $index, $column) {
                if(isset($model->combinationOrder))
                    return ['class' => ' bg-info','title'=>$model->combinatedPrintOrderName];
                else
                    return ['style' => ''];
            }
        ],
        [
            'attribute' => 'date_of_create',
            'label' => 'Дата создания',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center','style' => 'width:20%'],
        ],
        [
            'attribute' => 'status_id',
            'label' => 'Статус заказа',
            'value' => 'orderStatus.name',
            'filter' => ArrayHelper::map(OrderStatus::find()->asArray()->all(),'id','name'),
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center','style' => 'width:10%'],
        ],
        [
            'attribute' => 'label_status_id',
            'label' => 'Статус этикетки',
            'value' => 'label.labelStatus.name',
            'filter' => ArrayHelper::map(LabelStatus::find()->asArray()->all(),'id','name'),
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center','style' => 'width:10%'],
        ],
        [
            'attribute' => 'mashine_id',
            'label' => 'Станок',
            'value' => 'mashine.name',
            'filter' => ArrayHelper::map(Mashine::find()->asArray()->all(),'id','name'),
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center','style' => 'width:10%'],
        ],
        [
            'attribute' => 'manager_login',
            'label' => 'Менеджер',
            'value' => 'label.customer.managerFullName',
            'filter' => User::findUsersByGroup('manager'),
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center','style' => 'width:10%'],
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'contentOptions' => ['style' => 'width:40%'],
            'buttons' => [
                'view' => function($url, $model, $key) {     // render your custom button
                    return Html::a(Html::button( Icon::show('eye', ['class'=>'fa-0.5x'], Icon::FA),
                        ['class' => 'btn btn-outline-primary']), ['cms/order-view', 'id' => $model->id], ['class' => 'profile-link']);
                },
                'update' => function($url, $model, $key) {     // render your custom button
                    return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.5x'], Icon::FA),
                        ['class' => 'btn btn-outline-primary']), ['cms/order-update', 'id' => $model->id], ['class' => 'profile-link']);
                },
                'delete' => function($url, $model, $key) {     // render your custom button
                    return Html::a(Html::button( Icon::show('minus', ['class'=>'fa-0.5x'], Icon::FA),
                        ['class' => 'btn btn-outline-danger']), ['cms/order-delete', 'id' => $model->id], ['class' => 'profile-link']);
                },

            ]
        ],
    ],
]);
ActiveForm::end()
?>
