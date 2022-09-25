<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;

use kartik\icons\Icon;

$this->title = 'Штанцы';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?php echo  Html::encode($this->title) ?></h1>
<?php echo $this->render('_search', ['model' => $searchModel])?>
<div class="d-lg-flex flex-wrap">
    <div class="p-2"><?php echo  Html::a('Создать штанец', ['create'], ['class' => 'btn btn-success']) ?></div>
    <div class="p-2"><?php echo  Html::a('Создать вал', ['shaft/create'], ['class' => 'btn btn-success']) ?></div>
    <div class="p-2"><?php echo Html::a('Совместимость штанцев со станками', ['mashine-pants/index'], ['class' => 'btn btn-success'])?></div>
</div>


    <?php ActiveForm::begin(['method'=>'post'])?>
<div class="table-responsive">
    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                    'attribute'=>'shaft_id',
                    'value'=>'shaft.name',
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
    ])?>
</div>
    <?php ActiveForm::end()?>

