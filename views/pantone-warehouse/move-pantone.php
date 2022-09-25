<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Html::encode('Перемещение ЛКМ');
$this->params['breadcrumbs'][] = ['label' => 'Склад ЛКМ', 'url' => ['pantone-warehouse/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?php echo  Html::encode($this->title) ?></h2>
<?php $form=ActiveForm::begin()?>
<?php if(empty($pantone->id)):?>
<?php echo $form->field($pantone,'id',['inputOptions' =>
    ['autofocus' => 'autofocus']])->textInput()->label('Просканируйте штрихкод ЛКМ')?>
<?php else:?>
    <?php echo $form->field($pantone,'id')->hiddenInput()->label(false)?>
    <?php echo $form->field($pantone,'shelf_id',['inputOptions' =>
        ['autofocus' => 'autofocus']])->textInput()->label('Просканируйте штрихкод полки')?>
<?php endif;?>


<?php ActiveForm::end()?>