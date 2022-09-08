<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\grid\GridView;
use kartik\icons\Icon;
use app\models\User;


$this->title = 'Командировки сотрудников';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>
<?=$this->render('_search', ['model' => $searchModel])?>
<div class="d-lg-flex flex-wrap">
    <div class="p-2"> <?= Html::a('Добавить командировку', ['create'], ['class' => 'btn btn-success']) ?></div>
</div>
    <?ActiveForm::begin(['method'=>'post'])?>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'date_of_begin',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'date_of_end',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return User::getFullNameById($model->user_id);
                },
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'customer_id',
                'value' => 'customer.name',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'transport_id',
                'value'=>'transport.name',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'status_id',
                'value' => function($model){
                    switch ($model->status_id){
                        case 1: return 'Открыта';
                        case 2: return 'Закрыта';
                    }
                },
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit'),
                            ['class' => 'btn btn-outline-success']), ['business-trip-employee/update', 'id' => $model->id]);
                    },
                    'delete' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('minus'),
                            ['class' => 'btn btn-outline-danger']), ['business-trip-employee/delete', 'id' => $model->id]);
                    },
                    'view' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('eye'),
                            ['class' => 'btn btn-outline-success']), ['business-trip-employee/view', 'id' => $model->id]);
                    }
                ],
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
        ],
    ])?>
</div>
    <?ActiveForm::end()?>
