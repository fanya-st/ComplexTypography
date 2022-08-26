<?php

use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use app\models\Transport;
use yii\bootstrap5\ActiveForm;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\icons\Icon;
use app\models\User;


$this->title = 'Командировки сотрудников';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-trip-employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить командировку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?ActiveForm::begin(['method'=>'post'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            'date_of_end',

            [
                'attribute' => 'employee_login',
                'filter' => User::findUsersDropdown(),
                'value' => function($model){
                    return User::getFullNameByUsername($model->employee_login);
                },
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'transport_id',
                'filter'=>ArrayHelper::map(Transport::find()->asArray()->all(),'id','name'),
                'value'=>'transport.name',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'address',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'status_id',
                'filter' => [0=>'Открыта',1=>'Закрыта'],
                'value' => function($model){
                    switch ($model->status_id){
                        case 0: return 'Открыта';
                        case 1: return 'Закрыта';
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
    ]); ?>
    <?ActiveForm::end()?>


</div>
