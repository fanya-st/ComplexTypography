<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use app\models\Town;
use yii\bootstrap5\ActiveForm;
Icon::map($this, Icon::FA);


$this->title = 'Streets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="street-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Street', ['street-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?$form=ActiveForm::begin(['method'=>'post'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute'=>'town_id',
                'value'=>'town.name',
                'filter'=>ArrayHelper::map(Town::find()->asArray()->all(),'id','name'),
            ],
            'name',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['cms/street-update', 'id' => $model->id], ['class' => 'profile-link']);
                    }
                ]
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>


</div>
