<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\AuthItem;
use app\models\User;

?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->dropDownList(ArrayHelper::map(AuthItem::find()->where(['type'=>1])->asArray()->all(),'name','description')) ?>

    <?= $form->field($model, 'user_id')->dropDownList(User::findUsersIdDropdown()) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
