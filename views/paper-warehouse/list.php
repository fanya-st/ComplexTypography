<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use app\models\Material;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\MaterialGroup;
use kartik\field\FieldRange;
use kartik\icons\Icon;
use yii\web\View;
Icon::map($this, Icon::FA);

$this->title = 'Склад';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(
    "
function printDiv(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    ",
    View::POS_HEAD,
    'barcode-print'
);
?>
<h1><?= Html::encode($this->title) ?></h1>
<!--<pre>--><?//print_r()?><!--</pre>-->
<?//=$this->render('_search', ['model' => $searchModel])?>
<div class="d-inline-flex">
<div class="p-3">
    <?=Html::a('Загрузить пришедший материал', ['paper-warehouse/upload-paper'], ['class'=>'btn btn-primary'])?>
</div>
<div class="p-3">
    <?=Html::a('Загрузить пришедную бумагу на склад', ['paper-warehouse/upload-paper-to-warehouse'], ['class'=>'btn btn-primary'])?>
</div>
</div>
<? $form=ActiveForm::begin(['method' => 'post'])?>
<? echo GridView::widget([
    'dataProvider' => $paper_warehouse,
    'filterModel' => $searchModel,
    'id'=>'order-list',
    'columns' => [
        [
            'attribute' => 'id',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' => 'material_id',
            'value'=>'materialName',
            'label'=>'Наименование',
            'headerOptions' => ['class' => 'text-center','style' => 'width:30%'],
            'contentOptions'=>function($model) {
                        return ['title'=>$model->material->prompt];
                    },
//            'filter'=>Select2::widget([
//                'model' => $searchModel,
//                'attribute' => 'material_id',
//                'data' => ArrayHelper::map(Material::find()->joinWith('materialGroup')->asArray()->all(), 'id', 'name','materialGroup.name'),
//                'value' => 'material_id',
//                'options' => [
//                    'class' => 'form-control',
//                    'placeholder' => 'Выберите наименование'
//                ],
//            ])
            'filter'=>ArrayHelper::map(Material::find()->joinWith('materialGroup')->asArray()->all(), 'id', 'name','materialGroup.name')
        ],
        [
                'label'=>'Группа',
            'headerOptions' => ['class' => 'text-center'],
            'attribute' => 'materialGroupId',
            'value' => 'materialGroup.name',
            'filter'=>ArrayHelper::map(MaterialGroup::find()->asArray()->all(),'id','name')
        ],
        [
            'attribute' => 'width',
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions'=>['class' => 'text-center'],
            'filter'=>FieldRange::widget([
                'model' => $searchModel,
                'attribute1' => 'width_from',
                'attribute2' => 'width_to',
                'separator' => '<->',
            ])
        ],
        [
            'attribute' => 'length',
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions'=>['class' => 'text-center'],
        ],
        ['label'=>'Штрихкод',
            'contentOptions'=>['class' => 'text-center'],
            'value'=>function($model) {
//                Modal::begin([
//                    'title'=>Html::tag('h4', 'Штрихкод'),
//                    'id'=>'modal-'.$model->id,
//                    'centerVertical'=>true,
//                ]);
//                echo html::beginTag('div',['id'=>'modalContent-'.$model->id]);
//                echo Html::tag('p', Html::encode($model->material->name.' Ширина: '.$model->width.
//                    'мм Длина: '.$model->length.' м'),['class'=>'small text-center','style'=>'font-size:10px']);
//                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
//                echo Html::tag('div',Html::img('data:image/png;base64,' . base64_encode($generator->
//                    getBarcode(str_pad($model->id, 12, '0', STR_PAD_LEFT),
//                        $generator::TYPE_EAN_13,2, 70)) . '', ['alt' => 'barcode','class'=>'text-center']),
//                    ['class'=>'text-center']);
//                echo Html::tag('p', Html::encode($model->id),['class'=>'small text-center']);
//                echo html::endTag('div');
//                Modal::end();
//                return Html::button( Icon::show('print', ['class'=>'fa-1.5x'], Icon::FA),
//                    ['class' => 'btn btn-outline-primary','onclick'=>'printDiv("modalContent-'.$model->id.'")']);
                return Html::a('Штрихкод', ['paper-warehouse/barcode-print','id'=>$model->id], ['class'=>'btn btn-primary','target' => '_blank']);
            },
            'headerOptions' => ['class' => 'text-center'],
            'format'=>'raw'
        ],
//        ['class' => 'yii\grid\ActionColumn',
//            'template' => '{view}'
//        ],
    ],
]);


?>
<? ActiveForm::end()?>
