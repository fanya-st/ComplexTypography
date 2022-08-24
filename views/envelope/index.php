<?php

use app\models\Envelope;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use kartik\icons\Icon;
use kartik\select2\Select2;
use app\models\Shelf;


$this->title = 'Конверты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="envelope-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать конверт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<!--    <pre>--><?//print_r(Envelope::getDropDownOptionsColorTwo())?><!--</pre>-->
    <?ActiveForm::begin(['method'=>'post']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                    'attribute'=>'id',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                    'attribute'=>'color1',
                    'value'=>'colorOne',
                'format'=>'raw',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'filter'=>html::activeDropDownList($searchModel,'color1',
                    ArrayHelper::map(Envelope::$location['color1'],'id','name'),Envelope::getDropDownOptionsColorOne()),
            ],
//            [
//                    'attribute'=>'color1',
//                    'value'=>'colorOne',
//                'format'=>'raw',
//                'contentOptions'=>['class' => 'text-center'],
//                'headerOptions' => ['class' => 'text-center'],
//                'filter'=>Select2::widget([
//                        'model'=>$searchModel,
//                        'attribute'=>'color1',
//                        'data'=> ArrayHelper::map(Envelope::$location['color1'],'id','name'),
//                    'options' => Envelope::getDropDownOptionsColorOne(),
//                    'pluginOptions' => [
//                        'allowClear' => true,
//                    ],
//                ]),
//            ],
            [
                    'attribute'=>'color2',
                    'value'=>'colorTwo',
                'filter'=>html::activeDropDownList($searchModel,'color2',
                    ArrayHelper::map(Envelope::$location['color2'],'id','name'),
                    Envelope::getDropDownOptionsColorTwo()),

                'format'=>'raw',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute'=>'shelf_id',
//                'filter'=>ArrayHelper::map(Envelope::find()->all(),'shelf_id','shelf_id'),
                'filter'=>Select2::widget([
                        'model'=>$searchModel,
                        'attribute'=>'shelf_id',
                        'data'=> ArrayHelper::map(Shelf::find()->joinWith('rack.warehouse')->where(['warehouse.id'=>6])->asArray()->all(),'id','id'),
                    'options' => ['prompt'=>'Выберите полку...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view} {delete}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit'),
                            ['class' => 'btn btn-outline-success']), ['envelope/update', 'id' => $model->id]);
                    },
                    'delete' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('minus'),
                            ['class' => 'btn btn-outline-danger']), ['envelope/delete', 'id' => $model->id]);
                    },
                    'view' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('eye'),
                            ['class' => 'btn btn-outline-success']), ['envelope/view', 'id' => $model->id]);
                    }
                ],
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>
    <?ActiveForm::end();?>


<!--    --><?//=html::tag('svg',html::tag('rect','',['width'=>17, 'height'=>17,'style'=>'fill:cyan;']),['width'=>17, 'height'=>17])?>
</div>
