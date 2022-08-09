<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use app\models\Subject;
use yii\bootstrap5\ActiveForm;
Icon::map($this, Icon::FA);


$this->title = 'Regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    <pre>--><?//print_r(Yii::$app->request->post())?><!--</pre>-->
    <p>
        <?= Html::a('Create Region', ['region-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?$form=ActiveForm::begin(['method'=>'post'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                    'attribute'=>'subject_id',
                    'value'=>'subject.name',
                    'filter'=>ArrayHelper::map(Subject::find()->asArray()->all(),'id','name'),
            ],
            'name',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model, $key) {     // render your custom button
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.5x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['cms/region-update', 'id' => $model->id], ['class' => 'profile-link']);
                    }
                ]
            ],
        ],
    ]); ?>
    <?ActiveForm::end()?>

</div>
