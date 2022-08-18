<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
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

            'cost',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action,$model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'template'=>'{update} {delete}'
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>


</div>
