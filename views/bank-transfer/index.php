<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\BankTransfer;
use yii\helpers\ArrayHelper;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\Customer;
use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;
use app\models\User;
use kartik\icons\Icon;




$this->title = 'Банк';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-transfer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить поступление', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?ActiveForm::begin(['method'=>'post'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter' => true,
        'columns' => [
            [
                'attribute' => 'customer_id',
                'value'=>'customer.name',
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'customer_id',
                    'data' => ArrayHelper::map(Customer::find()->asArray()->all(),'id','name'),
                    'options' => [
                        'prompt' => ''
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]),
                'contentOptions'=>['class' => 'text-left'],
                'headerOptions' => ['class' => 'text-left'],
            ],
            [
                'label' => 'Менеджер',
                'value'=>function($model){
                    return User::getFullNameByUsername($model->customer->manager_login);
                },
                'filter'=>Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'manager_login',
                    'data' => User::findUsersByGroup('manager'),
                    'options' => [
                        'prompt' => ''
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]),
                'contentOptions'=>['class' => 'text-left'],
                'headerOptions' => ['class' => 'text-left'],
            ],
            [
                'attribute' => 'date',
                'filter'=>DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date',
                    'presetDropdown'=>true,
                    'convertFormat'=>true,
                    'pluginOptions' => ['locale' => ['format' => 'Y-m-d'],'selectOnClose'=>false],
                    'options' => ['placeholder' => 'Выберите дату...']
                ]),
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],

            [
                'attribute' => 'sum',
                'footer' => BankTransfer::getTotal($dataProvider->models, 'sum'),
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'footerOptions' => ['class' => 'text-center fw-bolder'],
            ],

//            'date_of_create',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit'),
                            ['class' => 'btn btn-outline-success']), ['bank-transfer/update', 'id' => $model->id]);
                    },
                    'delete' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('minus'),
                            ['class' => 'btn btn-outline-danger']), ['bank-transfer/delete', 'id' => $model->id]);
                    }
                ],
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>
        <?ActiveForm::end()?>

</div>
