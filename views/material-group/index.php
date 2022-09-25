<?php

use app\Models\MaterialGroup;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var app\Models\MaterialGroupSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Типы материалов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-responsive">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Добавить тип материала', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.1x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['material-group/update', 'id' => $model->id]);
                    },
                ]
            ],
        ],
    ]); ?>


</div>
