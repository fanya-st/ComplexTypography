<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Html::encode("Дизайн ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $label->name, 'url' => ['label/view','id'=>$label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?$form = ActiveForm::begin()?>
<h3><?= Html::encode($this->title)?></h3>
<!--<pre>--><?//print_r($label->image_file)?><!--</pre>-->
<!--<pre>--><?//print_r($label->image_crop_file)?><!--</pre>-->
<!--<pre>--><?//print_r($label->image_extended_file)?><!--</pre>-->
<!--<pre>--><?//print_r($label->design_file_file)?><!--</pre>-->
<!--<pre>--><?//print_r($label)?><!--</pre>-->
<div class="row">
    <div class="col">

    </div>
    <?=$form->field($label,'designer_note')->textarea()?>
    <?=$form->field($label,'image_file')->FileInput()?>
    <?=$form->field($label,'image_crop_file')->FileInput()?>
    <?=$form->field($label,'image_extended_file')->FileInput()?>
    <?if ($change_image!=1)echo $form->field($label,'design_file_file')->FileInput()?>

</div>
<?=Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>
