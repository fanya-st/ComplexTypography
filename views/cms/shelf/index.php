<?php

use yii\bootstrap5\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Rack;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Warehouse;


$this->title = 'Полки';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Добавить полку', ['shelf-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php ActiveForm::begin(['method'=>'post'])?>
<div class="table-responsive">
    <?php echo  GridView::widget([
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
                    'attribute'=>'warehouse_id',
                    'filter'=>ArrayHelper::map(Warehouse::find()->asArray()->all(),'id','name'),
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
    ])?>
</div>
    <?php ActiveForm::end()?>

