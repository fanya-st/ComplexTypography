<?php


use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Войти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>Пожалуйста заполните следущие поля для того, чтобы войти:</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?php echo  $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?php echo  $form->field($model, 'password')->passwordInput() ?>

            <?php echo  $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"offset-lg-0 col-lg-5 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>

            <div class="form-group">
                <div class="offset-lg-0 col-lg-11">
                    <?php echo  Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
