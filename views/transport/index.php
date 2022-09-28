<?php

use yii\bootstrap5\Html;
use kartik\icons\Icon;
use yii\grid\GridView;

/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Транспорт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transport-index">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Добавить транспорт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'name',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'car_number',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'load_capacity',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'subscribe',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit'),
                            ['class' => 'btn btn-outline-success']), ['transport/update', 'id' => $model->id]);
                    },
                    'delete' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('trash'),
                            ['class' => 'btn btn-outline-danger']), ['transport/delete', 'id' => $model->id]);
                    }
                ],
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>


</div>
