<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\User;
use app\models\Pants;
use yii\grid\GridView;

$this->title = Html::encode("Перевывод готов ID [$cur_label->id] $cur_label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $cur_label->name, 'url' => ['label/view','id'=>$cur_label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h3><?= Html::encode($this->title)?></h3>
    <h6>Перевывод выполнил: <?=User::getFullNameByUsername($cur_label->prepress_login)?></h6>
    <h6>Штанец №: <?=Pants::findOne($cur_label->pants_id)->name?></h6>
    <h6>Совмещение (ID этикеток): <?foreach ($cur_label->combinatedLabel as $label_id) echo '<span class=" badge rounded-pill bg-primary">'.$label_id.'</span>'?> </h6>
<?$form = ActiveForm::begin()?>
<?echo GridView::widget([
    'dataProvider' => $forms,
    'columns' => [
        'id',
        'pantoneName',
        'formDefect.name',
        'width',
        'height',
        'lpi',
        'dpi',
        'photoOutput.name',
    ]
])?>
<?=$form->field($prepress_file,'prepress_design_file_file')->FileInput()?>
<?=Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>
<!--<pre>--><?//print_r($prepress_file)?><!--</pre>-->
