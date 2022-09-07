<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\OrderStatus;
use app\models\User;
use app\models\Material;
use app\models\Sleeve;
use app\models\Winding;

$this->title = $order->label->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['cms/order-list']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="order-update">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col">

            <?= $form->field($order, 'status_id')->dropDownList(ArrayHelper::map(OrderStatus::find()->asArray()->all(), 'id', 'name')) ?>

            <?= $form->field($order, 'date_of_sale')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS'])?>

            <?= $form->field($order, 'date_of_print_begin')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?= $form->field($order, 'date_of_print_end')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?= $form->field($order, 'date_of_packing_begin')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?= $form->field($order, 'date_of_packing_end')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?= $form->field($order, 'date_of_rewind_begin')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?= $form->field($order, 'date_of_rewind_end')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?= $form->field($order, 'sending')->textInput() ?>

            <?= $form->field($order, 'label_price')->textInput() ?>

            <?= $form->field($order, 'label_price_with_tax')->textInput() ?>

        </div>
        <div class="col">
            <?= $form->field($order, 'material_id')->dropDownList(ArrayHelper::map(Material::find()->asArray()->all(), 'id', 'name')) ?>

            <?= $form->field($order, 'rewinder_id')->dropDownList(User::findUsersByGroup('rewinder'),['prompt'=>'Нет']) ?>

            <?= $form->field($order, 'packer_id')->dropDownList(User::findUsersByGroup('packer'),['prompt'=>'Нет']) ?>

            <?= $form->field($order, 'printer_id')->dropDownList(User::findUsersByGroup('printer'),['prompt'=>'Нет']) ?>

            <?= $form->field($order, 'rewinder_note')->textarea(['rows' => 1]) ?>

            <?= $form->field($order, 'printer_note')->textarea(['rows' => 1]) ?>

            <?= $form->field($order, 'tech_note')->textarea(['rows' => 1]) ?>

            <?= $form->field($order, 'sleeve_id')->dropDownList(ArrayHelper::map(Sleeve::find()->asArray()->all(), 'id', 'name')) ?>

            <?= $form->field($order, 'winding_id')->dropDownList(ArrayHelper::map(Winding::find()->asArray()->all(), 'id', 'name')) ?>

            <?= $form->field($order, 'label_on_roll')->textInput() ?>

            <?= $form->field($order, 'cut_edge')->dropDownList([0=>'Нет',1=>'Да']) ?>

            <?= $form->field($order, 'stretch')->dropDownList([0=>'Нет',1=>'Да']) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
