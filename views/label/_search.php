<?php
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use app\models\VarnishStatus;


?>

<div class="label-search">
    <?php $form = ActiveForm::begin([
        'action' => ['label/list'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'variable') ?>
    <?= $form->field($model, 'print_on_glue') ?>
    <?= $form->field($model, 'foil') ?>
    <?= $form->field($model, 'varnishStatusName')->dropDownList(VarnishStatus::find()->select(['name'])->indexBy('name')->column(), ['prompt'=>'Все']) ?>

    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
