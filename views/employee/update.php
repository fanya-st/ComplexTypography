<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use kartik\password\PasswordInput;


$this->title = $user->F.' '.$user->I.' '.$user->O;
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form=ActiveForm::begin()?>
<?php echo $form->field($user,'username')->textInput(['disabled'=>true])?>
<?php echo $form->field($user, 'password')->widget(PasswordInput::class, [])?>
<?php echo $form->field($user,'F')->textInput()?>
<?php echo $form->field($user,'I')->textInput()?>
<?php echo $form->field($user,'O')->textInput()?>
<?php echo $form->field($user,'status_id')->dropDownList([0=>'Работает',1=>'Уволен'])?>
<?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end()?>
