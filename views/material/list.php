<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use kartik\icons\Icon;

$this->title = 'Работа с материалами';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?=$this->render('_search', ['model' => $searchModel])?>
<div class="d-lg-flex flex-wrap">
    <div class="p-2"><?=Html::a('Создать материал', ['material/create'], ['class'=>'btn btn-primary'])?></div>
    <div class="p-2"><?=Html::a('Добавить тип материала', ['material-group/create'], ['class'=>'btn btn-primary'])?></div>
</div>
<? $form=ActiveForm::begin(['method' => 'post'])?>
<div class="table-responsive">
<?= GridView::widget([
    'dataProvider' => $material,
       'rowOptions'=>function($model){
            if($model->status==0){
                return ['class' => 'table-danger','title'=>'Материал в архиве'];
                }
            else return null;
            },
    'columns' => [
        [
            'attribute'=>'id',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'attribute'=>'material_group_id',
            'value'=>'materialGroup.name',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'attribute'=>'name',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'attribute'=>'short_name',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'attribute'=>'price_euro',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'attribute'=>'density',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'attribute'=>'material_provider_id',
            'value'=>'materialProvider.name',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {change_status}',
            'buttons' => [
                'update' => function($url, $model, $key) {     // render your custom button
                    return Html::a(Html::button( Icon::show('edit'),
                        ['class' => 'btn btn-outline-primary']), ['material/update', 'id' => $model->id]);
                },
                'change_status' => function($url, $model, $key) {
                    if($model->status!=0)
                    return Html::a(Html::button( Icon::show('minus'),
                        ['class' => 'btn btn-outline-danger']), ['material/inactive', 'id' => $model->id]);
                    else
                        return Html::a(Html::button( Icon::show('plus'),
                            ['class' => 'btn btn-outline-success']), ['material/active', 'id' => $model->id]);
                },
                'view' => function($url, $model, $key) {     // render your custom button
                    return Html::a(Html::button( Icon::show('eye'),
                        ['class' => 'btn btn-outline-success']), ['material/view', 'id' => $model->id]);
                }
            ],
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center','style'=>'width:15%;'],
        ],
    ],
])?>
</div>
<?ActiveForm::end()?>
