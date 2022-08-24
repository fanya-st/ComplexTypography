<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\icons\Icon;
use app\models\StockOnHandPaper;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use kartik\datetime\DateTimePicker;
use app\models\Material;
use app\models\MaterialGroup;

$this->title = Html::encode('Наличные складские запасы бумаги');
$this->params['breadcrumbs'][] = ['label' => 'Склад', 'url' => ['paper-warehouse/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?></h2>
<?$form=ActiveForm::begin()?>
<?=$form->field($searchModel,'date')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Введите дату ...'],
    'pluginOptions' => [
        'todayBtn' => true,
        'autoclose' => true
    ]
])?>

<?=$form->field($searchModel,'search_material_id')->dropDownList(ArrayHelper::map(Material::find()->joinWith('materialGroup')->asArray()->all(), 'id', 'name','materialGroup.name'),['prompt'=>''])?>
<?=$form->field($searchModel,'search_material_group_id')->dropDownList(ArrayHelper::map(MaterialGroup::find()->asArray()->all(),'id','name'),['prompt'=>''])?>
<?=html::submitButton('Показать',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>
<div class="table-responsive">
<table class="table">
    <thead>
    <tr>
        <th scope="col">Материал</th>
        <th scope="col">Группа</th>
        <th scope="col">Запасы</th>
    </tr>
    </thead>
    <tbody>
    <?if(!empty($items))foreach($items as $item):?>
    <tr>
        <td><?=$item->name?></td>
        <td><?=MaterialGroup::findOne($item->material_group_id)->name?></td>
        <td>
            <table class="table text-center table-bordered">
                <thead>
                <tr>
                    <th scope="col">Ширина, мм</th>
                    <th scope="col">Длина, м</th>
                    <th scope="col">Площадь, м2</th>
                </tr>
                </thead>
                <tbody>
                <?if(!empty($item->result)):?>
                <?foreach($item->result as $key=>$value):?>
                    <?if($value['on_date']!=0):?>
                <tr>
                    <td><?=$key?></td>
                    <td><?=$value['on_date']?></td>
                    <td><?=$value['square']?></td>
                </tr>
                        <?endif;?>
                <?endforeach;?>
                    <tr class="table-success">
                        <td colspan="2" class="text-center">Итого, м2</td>
                        <td><?=$item->result['square']?></td>
                    </tr>
                <?endif;?>
                </tbody>
            </table>
        </td>
    </tr>
    <?endforeach;?>
    </tbody>
</table>
</div>
<!--<pre>--><?//print_r($items)?><!--</pre>-->
<?//=GridView::widget([
//    'dataProvider' => $dataProvider,
//    'showFooter'=>true,
//    'columns' => [
//        [
//            'attribute' => 'id',
//            'label' => 'ID',
//            'contentOptions'=>['class' => 'text-center'],
//            'headerOptions' => ['class' => 'text-center'],
//        ],
//        [
//            'attribute' =>  'name',
//            'label' =>  'Наименование',
//            'contentOptions'=>['class' => 'text-center'],
//            'headerOptions' => ['class' => 'text-center'],
//        ],
//        [
//            'attribute' =>  'material_id',
//            'label' =>  'Группа',
//            'value' =>  'materialGroup.name',
//            'contentOptions'=>['class' => 'text-center'],
//            'headerOptions' => ['class' => 'text-center'],
//        ],
//        [
//            'label' =>  'Квадратура, м2',
//            'value' =>  function($model){
//                $model->stockOnHand(Yii::$app->request->post('StockOnHandPaperSearch')['stock_date']);
//                if(!empty($model->paper_warehouse))
//                    foreach($model->paper_warehouse as $paper_warehouse){
//                        $square+=$paper_warehouse->length*$paper_warehouse->width;
//                    }
//                return round($square/1000,2);
//            },
//            'contentOptions'=>['class' => 'text-center'],
//            'headerOptions' => ['class' => 'text-center'],
//            'footerOptions' => ['class' => 'text-center fw-bolder'],
//            'footer' => StockOnHandPaper::getTotal($dataProvider->models,Yii::$app->request->post('StockOnHandPaperSearch')['stock_date']),
//        ],
//
//    ]
//])?>




