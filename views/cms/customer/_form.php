<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

?>


<?php $form = ActiveForm::begin() ?>

    <div class="p-2"> <?php echo  $form->field($model, 'user_id')->dropDownList(User::findUsersByGroup('manager')) ?></div>
    <div class="p-2"> <?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?></div>

<?php ActiveForm::end()?>
