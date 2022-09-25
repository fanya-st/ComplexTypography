<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

?>



<?php $form = ActiveForm::begin() ?>

<div class="p-1"><?php echo  $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>

<div class="p-1"><?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?></div>

<?php ActiveForm::end() ?>


