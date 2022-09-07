<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use app\models\User;

$this->title = 'Работа с этикетками';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
        <?=$this->render('_search', ['model' => $searchModel])?>
<div class="table-responsive">
        <?=GridView::widget([
            'dataProvider' => $labels,
//            'filterModel' => $searchModel,
            'columns' => [
                ['attribute'=>'id',
                    'contentOptions'=>['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center','style' => 'min-width:70px']
                ],
                ['attribute'=>'name',
                    'headerOptions' => ['class' => 'text-center','style' => 'min-width:70px'],
//                    'value' => function($data)
//                    {
//                        return
//                            Html::a($data->name, ['label/view','id'=>$data->id], ['title' => $data->name]);
//                    }
                ],
                ['attribute'=>'date_of_create',
                    'contentOptions'=>['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center']
                ],
                [
                        'label'=>'Заказчик',
                        'value'=>'customer.name',
                    'headerOptions'=>['class' => 'text-center']
                ],
                [
                        'label'=>'Статус этикетки',
                        'value'=>'labelStatus',
                    'headerOptions'=>['class' => 'text-center']
                ],
                [
                        'attribute'=>'pants.id',
                    'label'=>'Штанец',
                    'headerOptions'=>['class' => 'text-center'],
                    'contentOptions'=>['class' => 'text-center'],
                ],
                ['attribute'=>'pants.shaft.name',
                    'label'=>'Вал',
                    'contentOptions'=>['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center']

                ],
                [
                    'label'=>'Менеджер',
                    'value'=>function($model){
                        return User::getFullNameById($model->customer->user_id);
                    },
                    'contentOptions'=>['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center']

                ],
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view}'
                ],
            ],
        ]);
        ?>
</div>
