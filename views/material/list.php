<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\MaterialProvider;
use app\models\MaterialGroup;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

$this->title = 'Работа с материалами';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<!--<pre>--><?//print_r(Yii::$app->request->post())?><!--</pre>-->
<div class="p-3">
    <?=Html::a('Создать материал', ['material/create'], ['class'=>'btn btn-primary'])?>
</div>
<?
$form=ActiveForm::begin(['method' => 'post']);
echo GridView::widget([
    'dataProvider' => $material,
    'filterModel' => $searchModel,
       'rowOptions'=>function($model){
            if($model->status==0){
                return ['class' => 'table-secondary','title'=>'Материал в архиве'];
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
            'filter' => ArrayHelper::map(MaterialGroup::find()->asArray()->all(),'id','name'),
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
            'attribute'=>'price_rub',
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
            'filter' => ArrayHelper::map(MaterialProvider::find()->asArray()->all(),'id','name'),
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center']
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{view},{update}'
        ],
    ],
]);
ActiveForm::end();
?>
