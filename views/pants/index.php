<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use app\models\Shaft;
use yii\helpers\ArrayHelper;
use app\models\PantsKind;
use yii\bootstrap5\ActiveForm;

use kartik\icons\Icon;
Icon::map($this, Icon::FA);

$this->title = 'Штанцы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pants-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать штанец', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Совместимость штанцев со станками', ['mashine-pants/index'], ['class' => 'btn btn-success']) ?>
    </p>

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
                'attribute' =>  'name',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                    'attribute'=>'shaft_id',
                    'value'=>'shaft.name',
                    'filter'=>ArrayHelper::map(Shaft::find()->asArray()->all(),'id','name'),
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' =>  'paper_width',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center','style' => 'width:5%'],
            ],
            [
                'attribute' => 'pants_kind_id',
                'value' => 'pantsKind.name',
                'filter'=>ArrayHelper::map(PantsKind::find()->asArray()->all(),'id','name'),
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' =>  'cuts',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center','style' => 'width:5%'],
            ],
            [
                'attribute' =>  'width_label',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center','style' => 'width:5%'],
            ],
            [
                'attribute' =>  'height_label',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center','style' => 'width:5%'],
            ],
            [
                'attribute' =>  'knife_width',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center','style' => 'width:5%'],
            ],

            //'knife_kind_id',

            //'picture',
            //'radius',
            //'gap',
            //'material_group_id',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.1x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['pants/update', 'id' => $model->id]);
                    },
                    'view' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('eye', ['class'=>'fa-0.1x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['pants/view', 'id' => $model->id]);
                    }
                ]
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>


</div>
