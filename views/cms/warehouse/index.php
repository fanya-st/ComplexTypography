<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;



$this->title = 'Склады';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить склад', ['warehouse-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?ActiveForm::begin(['method'=>'post'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a( 'Редактировать', ['cms/warehouse-update', 'id' => $model->id],
                            ['class' => 'glyphicon glyphicon-edit btn btn-primary']);
                    }
                ],
                 'template' => '{update}',
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>


</div>
