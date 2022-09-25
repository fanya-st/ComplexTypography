<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?php echo  Html::encode($this->title) ?></h1>
<!--    <pre>--><?php //print_r($model)?><!--</pre>-->
    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Спасибо за сообщение, мы свяжемся как можно быстрее
        </div>

        <p>
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?php echo  Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>
            Написать на почту администратора комплекса.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?php echo  $form->field($model, 'name')
                        ->hiddenInput(['value'=>Yii::$app->user->identity->F.' '.Yii::$app->user->identity->I])->label(false)

                    ?>

                    <?php echo  $form->field($model, 'subject') ?>

                    <?php echo  $form->field($model, 'body')->textarea(['autofocus' => true,'rows' => 6]) ?>

                    <div class="form-group">
                        <?php echo  Html::submitButton('Отправить письмо', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
