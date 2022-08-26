<?php

use yii\bootstrap5\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\bootstrap5\ActiveForm;
?>
<?php $form=ActiveForm::begin(['method' => 'post'])?>
<?//=Html::submitButton('Добавить в заказ',['name'=>'add_from_fpwarehouse','value'=>'start','class'=>'btn btn-primary'])?>
<?
echo GridView::widget([
    'dataProvider' => $roll,
    'columns' => [
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
            'contentOptions'=>function($model, $key, $index, $column) {
                if(!empty($model->defect_note))
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
