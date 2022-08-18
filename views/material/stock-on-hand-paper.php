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
<?=$form->field($searchModel,'stock_date')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Введите дату ...'],
    'pluginOptions' => [
        'todayBtn' => true,
        'autoclose' => true
    ]
])->label('Дата')?>

<?=$form->field($searchModel,'id')->dropDownList(ArrayHelper::map(Material::find()->joinWith('materialGroup')->asArray()->all(), 'id', 'name','materialGroup.name'),['prompt'=>''])?>
<?=$form->field($searchModel,'material_group_id')->dropDownList(ArrayHelper::map(MaterialGroup::find()->asArray()->all(),'id','name'),['prompt'=>''])?>
<?=html::submitButton('Показать',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'showFooter'=>true,
    'columns' => [
        [
            'attribute' => 'id',
            'label' => 'ID',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' =>  'name',
            'label' =>  'Наименование',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center'],
        ],
        [
            'attribute' =>  'material_id',
            'label' =>  'Группа',
            'value' =>  'materialGroup.name',
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center'],
        ],
        [
            'label' =>  'Квадратура, м2',
            'value' =>  function($model){
                $model->stockOnHand(Yii::$app->request->post('StockOnHandPaperSearch')['stock_date']);
                if(!empty($model->paper_warehouse))
                    foreach($model->paper_warehouse as $paper_warehouse){
                        $square+=$paper_warehouse->length*$paper_warehouse->width;
                    }
                return round($square/1000,2);
            },
            'contentOptions'=>['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center'],
            'footerOptions' => ['class' => 'text-center fw-bolder'],
            'footer' => StockOnHandPaper::getTotal($dataProvider->models,Yii::$app->request->post('StockOnHandPaperSearch')['stock_date']),
        ],

    ]
])?>




