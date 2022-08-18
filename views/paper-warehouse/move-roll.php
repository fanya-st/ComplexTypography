<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Html::encode('Перемещение роликов');
$this->params['breadcrumbs'][] = ['label' => 'Склад', 'url' => ['paper-warehouse/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?></h2>
<?$form=ActiveForm::begin()?>
<?if(empty($roll->id)):?>
<?=$form->field($roll,'id',['inputOptions' =>
    ['autofocus' => 'autofocus']])->textInput()->label('Просканируйте штрихкод ролика')?>
<?else:?>
    <?=$form->field($roll,'id')->hiddenInput()->label(false)?>
    <?=$form->field($roll,'shelf_id',['inputOptions' =>
        ['autofocus' => 'autofocus']])->textInput()->label('Просканируйте штрихкод полки')?>
<?endif;?>

<?//= Html::submitButton('Получить параметры штанца', ['class' => 'btn btn-success m-2']) ?>

<?ActiveForm::end()?>