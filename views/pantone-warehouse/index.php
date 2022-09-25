<?php
use yii\grid\GridView;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pantone;
use kartik\icons\Icon;

$this->title = 'Склад ЛКМ';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo  Html::encode($this->title) ?></h1>

<?php echo $this->render('_search', ['model' => $searchModel])?>

<div class="d-lg-flex flex-wrap p-2">
    <div class="p-1"><?php echo  Html::a('Добавить ЛКМ', ['create'], ['class' => 'btn btn-success']) ?></div>
    <div class="p-1"><?php echo Html::a('Перемещение ЛКМ', ['pantone-warehouse/move-pantone'], ['class'=>'btn btn-success'])?></div>
</div>


<?php ActiveForm::begin(['method'=>'post'])?>
    <div class="table-responsive">
    <?php echo  GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center','style' => 'width:5%'],
            ],
            [
                'attribute' =>  'pantone_id',
                'value' =>  'pantone.name',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' =>  'weight',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' =>  'date',
                'contentOptions'=>['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'label' => 'Местонахождение',
                'value' => function($model){
                    if(!empty($model->shelf_id))
                        return $model->shelf->rack->warehouse->name.'->'.$model->shelf->rack->name.'->Полка '.$model->shelf_id;
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions'=>['class' => 'text-center'],
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {barcode-print}',
                'buttons' => [
                    'update' => function($url, $model) {
                        return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.1x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['pantone-warehouse/update', 'id' => $model->id]);
                    },
                    'barcode-print' => function($url, $model) {
                        return Html::a(Html::button( Icon::show('print', ['class'=>'fa-0.1x'], Icon::FA),
                            ['class' => 'btn btn-outline-primary']), ['pantone-warehouse/barcode-print', 'id' => $model->id], ['target' => '_blank']);
                    }
                ]
            ],
        ],
    ])?>
    </div>
    <?php ActiveForm::end()?>
