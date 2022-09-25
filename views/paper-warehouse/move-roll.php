<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Html::encode('Перемещение роликов');
$this->params['breadcrumbs'][] = ['label' => 'Склад', 'url' => ['paper-warehouse/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?php echo  Html::encode($this->title) ?></h2>
<?php $form=ActiveForm::begin()?>
<?php if(empty($roll->id)):?>
<?php echo $form->field($roll,'id',['inputOptions' =>
    ['autofocus' => 'autofocus']])->textInput()->label('Просканируйте штрихкод ролика')?>
<?php else:?>
    <?php echo $form->field($roll,'id')->hiddenInput()->label(false)?>
    <?php echo $form->field($roll,'shelf_id',['inputOptions' =>
        ['autofocus' => 'autofocus']])->textInput()->label('Просканируйте штрихкод полки')?>
<?php endif;?>

<?php //= Html::submitButton('Получить параметры штанца', ['class' => 'btn btn-success m-2']) ?>

<?php ActiveForm::end()?>