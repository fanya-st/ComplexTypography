<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use app\models\Mashine;
use app\models\CalcMashineParam;
Icon::map($this, Icon::FA);

$this->title = 'Calc Mashine Param Prices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calc-mashine-param-price-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Calc Mashine Param Price', ['calc-mashine-param-price-create'], ['class' => 'btn btn-success']) ?>
    </p>
<!--    <pre>--><?//print_r(\app\models\Pants::findOne(1)->materialGroup)?><!--</pre>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?ActiveForm::begin(['method'=>'post'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',

            [
                    'attribute'=>'mashine_id',
                    'value'=>'mashine.name',
                    'filter'=>ArrayHelper::map(Mashine::find()->asArray()->all(),'id','name'),
            ],
            [
                    'attribute'=>'calc_mashine_param_id',
                    'value'=>'calcMashineParam.subscribe',
                    'filter'=>ArrayHelper::map(CalcMashineParam::find()->asArray()->all(),'id','subscribe'),
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
    <?activeform::end()?>


</div>
