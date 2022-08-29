<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Mashine;
use app\models\Material;
use app\models\Sleeve;
use app\models\Winding;


$this->title = '['.$order->id.'] '.$order->label->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $order->label->name, 'url' => ['view', 'id' => $order->id]];
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($order, 'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->asArray()->all(),'id','name')) ?>

<?= $form->field($order, 'plan_circulation')->textInput() ?>

<?= $form->field($order, 'sending')->textInput() ?>

<?= $form->field($order, 'material_id')->dropDownList(ArrayHelper::map(Material::find()->asArray()->all(),'id','name')) ?>

<?= $form->field($order, 'label_price')->textInput() ?>

<?= $form->field($order, 'label_price_with_tax')->textInput() ?>

<?= $form->field($order, 'manager_note')->textarea(['rows' => 6]) ?>

<?= $form->field($order, 'sleeve_id')->dropDownList(ArrayHelper::map(Sleeve::find()->asArray()->all(),'id','name')) ?>

<?= $form->field($order, 'winding_id')->dropDownList(ArrayHelper::map(Winding::find()->asArray()->all(),'id','name')) ?>

<?= $form->field($order, 'label_on_roll')->textInput() ?>

<?= $form->field($order, 'cut_edge')->dropDownList([
    '0' => 'Не срезать',
    '1' => 'Срезать',
]) ?>

<?= $form->field($order, 'stretch')->dropDownList([
    '0' => 'Нет',
    '1' => 'Да',
]) ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

