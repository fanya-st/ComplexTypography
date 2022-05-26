<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\LabelStatus;
use app\models\Label;
use kartik\daterange\DateRangePicker;
use app\models\Shaft;
use kartik\select2\Select2;
use app\models\Customer;
use app\models\Pants;

$this->title = 'Работа с этикетками';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<!--<pre>--><?php //print_r($searchModel->pantone)?><!--</pre>-->
<!--<p><a class="btn btn-outline-secondary" href="?r=label%2Fcreate">Создание этикетки &raquo;</a></p>-->
<?
//echo $this->render('_search', ['model' => $searchModel]);
echo GridView::widget([
    'dataProvider' => $labels,
    'filterModel' => $searchModel,
    'columns' => [
        ['attribute'=>'id',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center','style' => 'min-width:70px']
        ],
        'name',
        ['attribute'=>'date_of_create',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['style' => 'min-width:200px;','class' => 'text-center'],
            'filter' => DateRangePicker::widget([
                'attribute' => 'date_of_create',
                'containerOptions' => ['style' => 'min-width: 280px'],
                'model' => $searchModel,
                'presetDropdown' => true,
                'pluginOptions' => [
                    'opens'=>'left'
                ]
            ])
        ],
        ['attribute'=>'customerName',
            'headerOptions'=>['class' => 'text-center'],
            'filter'=>Select2::widget([
                'model' => $searchModel,
                'attribute' => 'customerName',
                'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1'])->all(), 'name', 'name'),
                'options' => ['placeholder' => 'Выберите...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])
        ],
        ['attribute'=>'labelStatusName',
            'filter'=>ArrayHelper::map(LabelStatus::find()->all(), 'name', 'name')
        ],
        ['attribute'=>'pantsName',
            'headerOptions'=>['class' => 'text-center'],
            'filter'=>Select2::widget([
                'model' => $searchModel,
                'attribute' => 'pantsName',
                'data' => ArrayHelper::map(Pants::find()->all(), 'name', 'name'),
                'options' => ['placeholder' => '...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])
        ],
        ['attribute'=>'shaftName',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center','style' => 'min-width:100px'],
            'filter'=>ArrayHelper::map(Shaft::find()->all(), 'name', 'name')

        ],
        ['attribute'=>'fullName',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center','style' => 'min-width:200px'],
            'filter'=>ArrayHelper::map(Label::find()->all(), 'designer_login', 'fullName')

        ],
        ['class' => 'yii\grid\ActionColumn',
        'template' => '{view}'
        ],
    ],
]);
?>