<?php

use yii\bootstrap5\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Rack;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = 'Полки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shelf-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить полку', ['shelf-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?ActiveForm::begin(['method'=>'post'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                    'attribute'=>'rack_id',
                    'value'=>'rack.name',
                    'filter'=>ArrayHelper::map(Rack::find()->asArray()->all(),'id','name'),
            ],
            [
                    'label'=>'Склад',
                    'value'=>function($model){
                        return $model->rack->warehouse->name;
                    },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a( 'Редактировать', ['cms/shelf-update', 'id' => $model->id],
                            ['class' => 'glyphicon glyphicon-edit btn btn-primary']);
                    }
                ],
                'template' => '{update}',
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>


</div>
