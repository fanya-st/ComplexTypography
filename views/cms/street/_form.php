<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Town;

?>


<?php $form = ActiveForm::begin(); ?>

<p><?php echo  $form->field($model, 'town_id')->dropDownList(ArrayHelper::map(Town::find()->asArray()->all(),'id','name')) ?></p>

<p><?php echo  $form->field($model, 'name')->textInput(['maxlength' => true]) ?></p>

<p><?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?></p>

<?php ActiveForm::end(); ?>

