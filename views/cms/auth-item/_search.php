<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo  $form->field($model, 'name') ?>

    <?php echo  $form->field($model, 'type') ?>

    <?php echo  $form->field($model, 'description') ?>

    <?php echo  $form->field($model, 'rule_name') ?>

    <?php echo  $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo  Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo  Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
