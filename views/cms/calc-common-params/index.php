<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use app\models\CalcCommonParams;

Icon::map($this, Icon::FA);


$this->title = 'Calc Common Params';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calc-common-params-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    <pre>--><?//print_r(CalcCommonParams::findOne(1)->getOldAttributes())?><!--</pre>-->
    <p>
        <?= Html::a('Create Calc Common Params', ['calc-common-params-create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'subscribe',
            'value',
            'date',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['cms/calc-common-params-update', 'id' => $model->id], ['class' => 'profile-link']);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
