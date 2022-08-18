<?php

use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use app\models\EnterpriseCostService;
use app\models\User;


?>

<div class="enterprise-cost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login')->dropDownList(User::findUsersDropdown(),['prompt'=>'Без указания сотрудника']) ?>

    <?= $form->field($model, 'service_id')->dropDownList(ArrayHelper::map(EnterpriseCostService::find()->asArray()->all(),'id','name')) ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
