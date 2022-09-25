<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use yii\bootstrap5\ActiveForm;

$this->title = 'Параметры машин';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Добавить параметр станка', ['calc-mashine-param-price-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', compact('searchModel'))?>
<div class="table-responsive">
    <?php ActiveForm::begin(['method'=>'post'])?>
    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',

            [
                    'attribute'=>'mashine_id',
                    'value'=>'mashine.name',
            ],
            [
                    'attribute'=>'calc_mashine_param_id',
                    'value'=>'calcMashineParam.subscribe',
            ],

            'value',
            'date',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['cms/calc-mashine-param-price-update', 'id' => $model->id], ['class' => 'profile-link']);
                    },
                    'view' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('eye', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['cms/calc-mashine-param-price-view', 'id' => $model->id], ['class' => 'profile-link']);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Activeform::end()?>
    </div>
