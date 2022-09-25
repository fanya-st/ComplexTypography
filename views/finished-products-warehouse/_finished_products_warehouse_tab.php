<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use app\models\User;
?>
<?php $form=ActiveForm::begin(['method' => 'post'])?>
<?php echo Html::submitButton('Добавить в заказ',['name'=>'add_from_fpwarehouse','value'=>'start','class'=>'btn btn-primary'])?>
<?php
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
            'attribute' => 'label.customer.user_id',
            'value'=>function($model){
                return User::getFullNameById($model->customer->user_id);
            },
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
