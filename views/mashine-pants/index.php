<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Mashine;
use app\models\Pants;
use yii\bootstrap5\ActiveForm;

use kartik\icons\Icon;
Icon::map($this, Icon::FA);

$this->params['breadcrumbs'][] = ['label' => 'Штанцы', 'url' => ['pants/index']];
$this->title = 'Совместимость штанцев со станками';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mashine-pants-index">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php ActiveForm::begin(['method'=>'post'])?>

    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'mashine_id',
                'value'=>'mashine.name',
                'filter'=>ArrayHelper::map(Mashine::find()->asArray()->all(),'id','name'),
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute'=>'pants_id',
                'filter'=>ArrayHelper::map(Pants::find()->asArray()->all(),'id','id'),
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.1x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['mashine-pants/update', 'id' => $model->id]);
                    },
//                    'view' => function($url, $model, $key) {     // render your custom button
//                        return Html::a(Html::button( Icon::show('eye', ['class'=>'fa-0.1x'], Icon::FA),
//                            ['class' => 'btn btn-outline-primary']), ['mashine-pants/view', 'id' => $model->id]);
//                    }
                ]
            ],
        ],
    ]); ?>
    <?php ActiveForm::end()?>


</div>
