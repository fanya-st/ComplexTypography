<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\icons\Icon;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use app\models\EnterpriseCostService;
use app\models\User;


$this->title = 'Затраты предприятия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enterprise-cost-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить расход', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?ActiveForm::begin(['method'=>'post'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'date',

            [
                'attribute'=>'login',
                'value'=>function($model){
                return User::getFullNameByUsername($model->login);
                },
                'filter'=>User::findUsersDropdown(),
            ],
            [
                    'attribute'=>'service_id',
                    'value'=>'enterpriseCostService.name',
                    'filter'=>ArrayHelper::map(EnterpriseCostService::find()->asArray()->all(),'id','name'),
            ],
            [
                    'attribute'=>'order_id',
//                    'filter'=>ArrayHelper::map(EnterpriseCostService::find()->asArray()->all(),'id','name'),
            ],

            'cost',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit'),
                            ['class' => 'btn btn-outline-success']), ['enterprise-cost/update', 'id' => $model->id]);
                    },
                    'delete' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('minus'),
                            ['class' => 'btn btn-outline-danger']), ['enterprise-cost/delete', 'id' => $model->id]);
                    }
                ],
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>


</div>
