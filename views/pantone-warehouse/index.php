<?php

use yii\grid\GridView;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pantone;

use kartik\icons\Icon;
Icon::map($this, Icon::FA);


$this->title = 'Склад ЛКМ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pantone-warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-inline-flex">
        <div class="p-2">
            <?= Html::a('Добавить ЛКМ', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="p-2">
            <?=Html::a('Перемещение ЛКМ', ['pantone-warehouse/move-pantone'], ['class'=>'btn btn-success'])?>
        </div>
    </div>


    <?ActiveForm::begin(['method'=>'post'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center','style' => 'width:5%'],
            ],
            [
                'attribute' =>  'pantone_id',
                'value' =>  'pantone.name',
                'filter'=>ArrayHelper::map(Pantone::find()->asArray()->all(),'id','name'),
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' =>  'weight',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' =>  'date',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'label' => 'Местонахождение',
                'value' => function($model){
                    if(!empty($model->shelf_id))
                        return $model->shelf->rack->warehouse->name.'->'.$model->shelf->rack->name.'->Полка '.$model->shelf_id;
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions'=>['class' => 'text-center'],
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {barcode-print}',
                'buttons' => [
                    'update' => function($url, $model) {
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.1x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['pantone_warehouse/update', 'id' => $model->id]);
                    },
                    'barcode-print' => function($url, $model) {
                        return Html::a(Html::button( Icon::show('print', ['class'=>'fa-0.1x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['pantone-warehouse/barcode-print', 'id' => $model->id], ['target' => '_blank']);
                    }
                ]
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>


</div>
