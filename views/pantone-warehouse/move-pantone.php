<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Html::encode('Перемещение ЛКМ');
$this->params['breadcrumbs'][] = ['label' => 'Склад ЛКМ', 'url' => ['pantone-warehouse/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?></h2>
<?$form=ActiveForm::begin()?>
<?if(empty($pantone->id)):?>
<?=$form->field($pantone,'id',['inputOptions' =>
    ['autofocus' => 'autofocus']])->textInput()->label('Просканируйте штрихкод ЛКМ')?>
<?else:?>
    <?=$form->field($pantone,'id')->hiddenInput()->label(false)?>
    <?=$form->field($pantone,'shelf_id',['inputOptions' =>
        ['autofocus' => 'autofocus']])->textInput()->label('Просканируйте штрихкод полки')?>
<?endif;?>


<?ActiveForm::end()?>