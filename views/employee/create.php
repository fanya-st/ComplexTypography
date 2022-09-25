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
<?php echo $form->field($user,'username')->textInput()?>
<?php echo $form->field($user, 'password')->widget(PasswordInput::class, [])?>
<?php echo $form->field($user,'F')->textInput()?>
<?php echo $form->field($user,'I')->textInput()?>
<?php echo $form->field($user,'O')->textInput()?>
<?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end()?>
