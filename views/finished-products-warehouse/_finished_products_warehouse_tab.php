<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
?>
<?php $form=ActiveForm::begin(['method' => 'post'])?>
<!--<pre>--><?//print_r(Yii::$app->request->post())?><!--</pre>-->
<?=Html::submitButton('Добавить в заказ',['name'=>'add_from_fpwarehouse','value'=>'start','class'=>'btn btn-primary'])?>
<?//=Html::submitButton('test',['name'=>'test','class'=>'btn btn-primary'])?>
<?
echo GridView::widget([
    'dataProvider' => $surplus,
    'columns' => [
        [
            'class' => 'yii\grid\CheckboxColumn',
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
            'attribute' => 'label.managerName',
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
