<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
//use yii\bootstrap5\ActiveForm;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\MaterialGroup;
use kartik\field\FieldRange;

$this->title = 'Склад';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<!--<pre>--><?//print_r(Yii::$app->request->post())?><!--</pre>-->
<?//=$this->render('_search', ['model' => $searchModel])?>
<? $form=ActiveForm::begin(['method' => 'post'])?>
<? echo GridView::widget([
    'dataProvider' => $paper_warehouse,
    'filterModel' => $searchModel,
    'id'=>'order-list',
    'columns' => [
        'id',
        [
            'attribute' => 'materialName',
        ],
        [
                'label'=>'Группа',
            'attribute' => 'materialGroupId',
            'value' => 'materialGroup.name',
            'filter'=>ArrayHelper::map(MaterialGroup::find()->asArray()->all(),'id','name')
        ],
        [
            'attribute' => 'width',
            'filter'=>FieldRange::widget([
                'model' => $searchModel,
                'attribute1' => 'width_from',
                'attribute2' => 'width_to',
                'separator' => '<->',
            ])
        ],
        'length',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}'
        ],
    ],
]);
ActiveForm::end()
?>
