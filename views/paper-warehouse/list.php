<?php
use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;

$this->title = 'Склад';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?=$this->render('_search', ['model' => $searchModel])?>

<div class="d-lg-flex flex-wrap">
    <div class="p-1"><?=Html::a('Загрузить пришедший материал', ['paper-warehouse/upload-paper'], ['class'=>'btn btn-primary'])?></div>
    <div class="p-1"><?=Html::a('Загрузить пришедную бумагу на склад', ['paper-warehouse/upload-paper-to-warehouse'], ['class'=>'btn btn-primary'])?></div>
    <div class="p-1"><?=Html::a('Перемещение роликов', ['paper-warehouse/move-roll'], ['class'=>'btn btn-primary'])?></div>
</div>

<? $form=ActiveForm::begin(['method' => 'post'])?>
<div class="table-responsive">
<? echo GridView::widget([
    'dataProvider' => $paper_warehouse,
    'id'=>'order-list',
    'columns' => [
        [
            'attribute' => 'id',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'material_id',
            'value'=>'material.name',
            'label'=>'Наименование',
            'headerOptions' => ['class' => 'text-center','style' => 'width:30%'],
            'contentOptions'=>function($model) {
                        return ['title'=>$model->material->prompt,'class' => 'text-center'];
                    },
        ],
        [
                'label'=>'Группа',
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'value' => 'materialGroup.name',
        ],
        [
            'attribute' => 'width',
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions'=>['class' => 'text-center'],
        ],
        [
            'attribute' => 'length',
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions'=>['class' => 'text-center'],
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
        ['label'=>'QR-код',
            'contentOptions'=>['class' => 'text-center'],
            'value'=>function($model) {
                return Html::a('QR-код', ['paper-warehouse/barcode-print','id'=>$model->id], ['class'=>'btn btn-primary','target' => '_blank']);
            },
            'headerOptions' => ['class' => 'text-center','style' => 'width:10%'],
            'format'=>'raw'
        ],
    ],
]);
?>
</div>
<? ActiveForm::end()?>
