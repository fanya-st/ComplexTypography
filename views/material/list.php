<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

$this->title = 'Работа с материалами';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<!--<pre>--><?//print($material->materialGroup)?><!--</pre>-->
<?//echo $this->render('_search', ['model' => $searchModel])?>
<?//
//Modal::begin([
//    'title'=>'<h4>Создать отгрузку</h4>',
//    'toggleButton' => ['label' => 'Создать отгрузку', 'class' => 'btn btn-primary'],
//    'id'=>'modal',
//    'centerVertical'=>true,
//]);
//$shipment = new Shipment();
//$form=ActiveForm::begin(['action'=>'shipment/create','id' => 'shipment-form']);
//echo $form->field($shipment,'date_of_send')->widget(DatePicker::classname(), [
//    'options' => ['placeholder' => 'Введите дату отправки ...'],
//    'pluginOptions' => [
//        'allowClear' => true,
//        'autoClose' => true,
//        'format' => 'yyyy-mm-dd',
//    ]
//])->label(false);
//echo Html::submitButton('Создать',['class'=>'btn btn-success']);
//ActiveForm::end();
//Modal::end();
//?>
<!--<div class="border p-3">-->
<!--    <div class="col d-flex">-->
<!--        --><?// $form=ActiveForm::begin([]);
//        echo $form->field($new_shipment,'date_of_send')->widget(DatePicker::classname(), [
//            'options' => ['placeholder' => 'Введите дату отправки ...'],
//            'pluginOptions' => [
//                'allowClear' => true,
//                'autoClose' => true,
//                'format' => 'yyyy-mm-dd',
//            ]
//        ])->label(false);
//        echo Html::submitButton('Создать',['class'=>'btn btn-success']);
//        ActiveForm::end()?>
<!--    </div>-->
<!--</div>-->
<?
$form=ActiveForm::begin(['method' => 'post']);
echo GridView::widget([
    'dataProvider' => $material,
//    'filterModel' => $searchModel,
    'columns' => [
        [
            'attribute'=>'id',
        ],
        [
            'attribute'=>'materialGroup.name',
        ],
        [
            'attribute'=>'name',
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}'
        ],
    ],
]);
ActiveForm::end();
?>
