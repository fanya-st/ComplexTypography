<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use app\models\User;
use yii\bootstrap5\ActiveForm;

$this->title = 'Работа с излишками';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php $form=ActiveForm::begin(['method' => 'post'])?>
<?
echo GridView::widget([
    'dataProvider' => $surplus,
            'filterModel' => $searchModel,
    'columns' => [
        ['attribute'=>'id',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        ['attribute'=>'label_id',
            'label'=>'Этикетка',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        ['attribute'=>'label.name',
            'contentOptions'=>['class' => 'text-center'],
            'value'=>function($model, $key, $index, $column) {
                return Html::a($model->label->name,['label/view','id'=>$model->label_id],['target'=>'_blank']);
            },
            'headerOptions' => ['class' => 'text-center'],
            'format' => 'raw'
        ],
        [
            'label'=>'Менеджер',
            'attribute'=>'manager_id',
            'value' => function($model){return User::getFullNameById($model->label->customer->user_id);},
            'filter' => User::findUsersByGroup('manager'),
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        ['attribute'=>'label_in_roll',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        ['attribute'=>'roll_count',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        ['attribute'=>'defect_note',
            'label'=>'Примечание брака',
//            'contentOptions'=>['class' => 'text-center'],
            'contentOptions'=>function($model, $key, $index, $column) {
                    if(isset($model->defect_note))
                        return ['class' => 'bg-danger text-center'];
                    else
                        return ['class' => 'text-center'];
                 },
            'headerOptions' => ['class' => 'text-center']
        ],
    ],
]);
?>
<?php ActiveForm::end()?>
