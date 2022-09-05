<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Mashine;
use app\models\CalcMashineParam;

?>


    <?php $form = ActiveForm::begin([
        'action' => ['cms/calc-mashine-param-price-index'],
        'method' => 'post',
    ]); ?>
    <div class="d-lg-flex flex-wrap">
        <div class="p-1"><?= $form->field($searchModel, 'id')->textInput() ?></div>
        <div class="p-1"><?= $form->field($searchModel, 'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->asArray()->all(),'id','name'),['prompt'=>'']) ?></div>
        <div class="p-1"><?= $form->field($searchModel, 'calc_mashine_param_id')->dropDownList(ArrayHelper::map(CalcMashineParam::find()->asArray()->all(),'id','subscribe'),['prompt'=>'']) ?></div>
    </div>
    <div class="d-inline-flex">
        <div class="p-1"><?= Html::submitButton('Поиск', ['class' => 'btn btn-success']) ?></div>
        <div class="p-1"><?= Html::resetButton('Сброс', ['class' => 'btn btn-outline-secondary']) ?></div>
        </div>


    <?php ActiveForm::end(); ?>

