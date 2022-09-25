<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Html::encode("Дизайн ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $label->name, 'url' => ['label/view','id'=>$label->id]];
?>
<?php $form = ActiveForm::begin()?>
<h3><?php echo  Html::encode($this->title)?></h3>
<div class="row">
    <div class="col">

    </div>
    <?php echo $form->field($label,'designer_note')->textarea()?>
    <?php echo $form->field($design_file,'image_file')->FileInput()?>
    <?php echo $form->field($design_file,'image_crop_file')->FileInput()?>
    <?php echo $form->field($design_file,'image_extended_file')->FileInput()?>
    <?php echo $form->field($design_file,'design_file_file')->FileInput()?>

</div>
<?php echo Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?php ActiveForm::end()?>
