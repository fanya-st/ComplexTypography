<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

$this->title = 'Работа с этикетками';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
        <?
        echo $this->render('_search', ['model' => $searchModel]);
        echo GridView::widget([
            'dataProvider' => $labels,
//            'filterModel' => $searchModel,
            'columns' => [
                ['attribute'=>'id',
                    'contentOptions'=>['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center','style' => 'min-width:70px']
                ],
                'name',
                ['attribute'=>'date_of_create',
                    'contentOptions'=>['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center']
                ],
                ['attribute'=>'customerName',
                    'headerOptions'=>['class' => 'text-center']
                ],
                ['attribute'=>'labelStatusName'
                ],
                ['attribute'=>'pantsName',
                    'headerOptions'=>['class' => 'text-center']
                ],
                ['attribute'=>'shaftName',
                    'contentOptions'=>['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center']

                ],
                ['attribute'=>'fullName',
                    'contentOptions'=>['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center']

                ],
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view}'
                ],
            ],
        ]);
        ?>
