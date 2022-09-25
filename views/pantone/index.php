<?php

use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\PantoneKind;
use kartik\icons\Icon;

$this->title = 'Пантоны';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?php echo  Html::encode($this->title) ?></h1>
<?php echo $this->render('_search', ['model' => $searchModel])?>
    <div class="d-inline-flex">
        <div class="p-2">
            <?php echo  Html::a('Добавить PANTONE', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
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
                'attribute' =>  'name',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],

            [
                'attribute' => 'pantone_kind_id',
                'value' => 'pantoneKind.name',
                'filter'=>ArrayHelper::map(PantoneKind::find()->asArray()->all(),'id','name'),
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'value' => function($model){
                    if(!empty($model->mixedPantone)){
                        foreach ($model->mixedPantone as $p){
                            if(!empty($p->pantone->name))
                                $list.=$p->pantone->name.',';
                        }
                        return $list;
                    } else {
                        return '';
                    }
                },
                'label'=>'Состав',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute'=>'mashine_list',
                'value'=>function($model){
                    foreach ($model->mashine as $mashine){
                        $list.=$mashine->name.', ';
                    }
                    return $list;
                },
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view}',
                'buttons' => [
                    'update' => function($url, $model) {
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.1x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['pantone/update', 'id' => $model->id]);
                    },
                    'view' => function($url, $model) {
                        return Html::a(Html::button( Icon::show('eye', ['class'=>'fa-0.1x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['pantone/view', 'id' => $model->id]);
                    }
                ]
            ],
        ],
    ])?>
</div>
<?php ActiveForm::end()?>

