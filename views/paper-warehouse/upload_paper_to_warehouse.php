<?php
use yii\grid\GridView;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Html::encode("Загрузка пришедшей бумаги на склад");
$this->params['breadcrumbs'][] = ['label' => 'Склад', 'url' => ['paper-warehouse/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?></h2>
<!--<pre>--><?//print_r($upload_paper_list)?><!--</pre>-->
<?php $form = ActiveForm::begin()?>
<?=$form->field($upload_paper_form,'barcode',['inputOptions' =>
    ['autofocus' => 'autofocus']])->textInput()->label('Просканируйте штрихкод ролика или палета')?>
<?=Html::submitButton('Ввод',['class'=>'btn btn-success'])?>
<?php ActiveForm::end() ?>
<div class="table-responsive">
<?=GridView::widget([
    'dataProvider' => $paper,
    'columns' => [
        'id',
        'material.name',
        'pallet_id',
        'width',
        'length',
        'material_id_from_provider',
        'roll_id',
//        [
//            'class' => 'yii\grid\ActionColumn',
//            'template' => '{delete}',
//            'buttons' => ['delete' => function($url, $model){
//                return Html::a('<span class="fa fa-trash"></span>', ['prepress-delete-form', 'form_id' => $model->id], [
//                    'class' => '',
//                    'data' => [
//                        'confirm' => 'ВЫ уверены?',
//                        'method' => 'post',
//                    ],
//                ]);
//            }],
//        ],
    ]
])?>
</div>