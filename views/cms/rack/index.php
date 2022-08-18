<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Warehouse;
use yii\bootstrap5\ActiveForm;


$this->title = 'Стеллажи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rack-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить стеллаж', ['rack-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?ActiveForm::begin(['method'=>'post'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                    'attribute'=>'warehouse_id',
                    'value'=>'warehouse.name',
                    'filter'=>ArrayHelper::map(Warehouse::find()->asArray()->all(),'id','name'),
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a( 'Редактировать', ['cms/rack-update', 'id' => $model->id],
                            ['class' => 'glyphicon glyphicon-edit btn btn-primary']);
                    }
                ],
                'template' => '{update}',
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>


</div>
