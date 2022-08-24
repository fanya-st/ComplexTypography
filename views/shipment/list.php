<?php


use yii\bootstrap5\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\bootstrap5\ActiveForm;
use kartik\date\DatePicker;
use app\models\User;
use kartik\daterange\DateRangePicker;

$this->title = 'Работа с отгрузками';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?//echo $this->render('_search', ['model' => $searchModel])?>
<?//
//Modal::begin([
//    'title'=>'<h4>Создать отгрузку</h4>',
//    'toggleButton' => ['label' => 'Создать отгрузку', 'class' => 'btn btn-primary'],
//    'id'=>'modal',
//    'centerVertical'=>true,
//]);
//$shipment = new Shipment();
//$form=ActiveForm::begin(['action'=>'shipment/create','id' => 'shipment-form']);
//echo $form->field($shipment,'date_of_send')->widget(DatePicker::classname(), [
//    'options' => ['placeholder' => 'Введите дату отправки ...'],
//    'pluginOptions' => [
//        'allowClear' => true,
//        'autoClose' => true,
//        'format' => 'yyyy-mm-dd',
//    ]
//])->label(false);
//echo Html::submitButton('Создать',['class'=>'btn btn-success']);
//ActiveForm::end();
//Modal::end();
//?>
<div class="border p-3">
    <div class="col d-flex">
        <? $form=ActiveForm::begin([]);
        echo $form->field($new_shipment,'date_of_send')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Введите дату отправки ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'autoClose' => true,
                'format' => 'yyyy-mm-dd',
            ]
        ])->label(false);
        echo Html::submitButton('Создать',['class'=>'btn btn-success']);
        ActiveForm::end()?>
    </div>
</div>
<?
$form=ActiveForm::begin(['method' => 'post']);
echo GridView::widget([
    'dataProvider' => $shipments,
    'filterModel' => $searchModel,
    'columns' => [
        [
                'attribute'=>'id',
        ],
        [
            'attribute' => 'manager_login',
            'value' => function($model){
                return User::getFullNameByUsername($model->manager_login);
            },
            'filter' => User::findUsersByGroup('manager')
        ],
        [
            'attribute' => 'shipmentWeight',
            'label' => 'Вес, кг',
        ],

        [
            'attribute' => 'boxBaleCount',
            'label' => 'Кол-во',
        ],
        [
            'attribute' => 'townList',
            'label' => 'Города',
            'value' => function($model){
                if(!empty($model->townList))
                foreach ($model->townList as $town) $list.=$town.', ';
                return $list;
            },
        ],
        [
            'attribute' => 'date_of_create',
            'value' => 'date_of_create',
            'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'date_of_create',
                'convertFormat' => true,
                'presetDropdown'=>true,
                'pluginOptions' => [
                    'format'=>'Y-m-d',
                    'locale' => [
                        'format' => 'd.m.Y',
                        'separator' => ' | ',
                    ],
                ],
            ]),
        ],
        [
            'attribute' => 'date_of_send',
            'value' => 'date_of_send',
            'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'date_of_send',
                'convertFormat' => true,
                'presetDropdown'=>true,
                'pluginOptions' => [
                    'format'=>'Y-m-d',
                    'locale' => [
                        'format' => 'd.m.Y',
                        'separator' => ' | ',
                    ],
                ],
            ]),
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}'
        ],
    ],
    'responsive'=>true,
]);
ActiveForm::end();
?>
