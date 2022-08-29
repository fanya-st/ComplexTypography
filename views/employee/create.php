<?php
use yii\bootstrap5\ActiveForm;
use app\models\User;
use yii\bootstrap5\Html;
use kartik\password\PasswordInput;


$this->title = 'Добавление сотрудника';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form=ActiveForm::begin()?>
<?=$form->field($user,'username')->textInput()?>
<?=$form->field($user, 'password')->widget(PasswordInput::class, [])?>
<?=$form->field($user,'F')->textInput()?>
<?=$form->field($user,'I')->textInput()?>
<?=$form->field($user,'O')->textInput()?>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end()?>
