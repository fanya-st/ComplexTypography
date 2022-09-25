<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use app\models\Region;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;


$this->title = 'Города';
$this->params['breadcrumbs'][] = $this->title;
?>


    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Добавить город', ['town-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $form=ActiveForm::begin(['method'=>'post'])?>
<div class="table-responsive">
    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute'=>'region_id',
                'value'=>'region.name',
                'filter'=>ArrayHelper::map(Region::find()->asArray()->all(),'id','name'),
            ],
            'name',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['cms/town-update', 'id' => $model->id], ['class' => 'profile-link']);
                    }
                ]
            ],
        ],
    ])?>
</div>
    <?php ActiveForm::end()?>


