<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use kartik\password\PasswordInput;


$this->title = $user->F.' '.$user->I.' '.$user->O;
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form=ActiveForm::begin()?>
<?=$form->field($user, 'password')->widget(PasswordInput::class, [])?>
<?=$form->field($user,'F')->textInput()?>
<?=$form->field($user,'I')->textInput()?>
<?=$form->field($user,'O')->textInput()?>
<?=$form->field($user,'status_id')->dropDownList([0=>'Работает',1=>'Уволен'])?>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end()?>
