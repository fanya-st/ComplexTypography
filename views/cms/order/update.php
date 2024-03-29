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

            <?php echo  $form->field($order, 'status_id')->dropDownList(ArrayHelper::map(OrderStatus::find()->asArray()->all(), 'id', 'name')) ?>

            <?php echo  $form->field($order, 'date_of_sale')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS'])?>

            <?php echo  $form->field($order, 'date_of_print_begin')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?php echo  $form->field($order, 'date_of_print_end')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?php echo  $form->field($order, 'date_of_packing_begin')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?php echo  $form->field($order, 'date_of_packing_end')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?php echo  $form->field($order, 'date_of_rewind_begin')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?php echo  $form->field($order, 'date_of_rewind_end')->textInput(['placeholder'=>'YYYY-MM-DD HH:MI:SS']) ?>

            <?php echo  $form->field($order, 'sending')->textInput() ?>

            <?php echo  $form->field($order, 'label_price')->textInput() ?>

            <?php echo  $form->field($order, 'label_price_with_tax')->textInput() ?>

        </div>
        <div class="col">
            <?php echo  $form->field($order, 'material_id')->dropDownList(ArrayHelper::map(Material::find()->asArray()->all(), 'id', 'name')) ?>

            <?php echo  $form->field($order, 'rewinder_id')->dropDownList(User::findUsersByGroup('rewinder'),['prompt'=>'Нет']) ?>

            <?php echo  $form->field($order, 'packer_id')->dropDownList(User::findUsersByGroup('packer'),['prompt'=>'Нет']) ?>

            <?php echo  $form->field($order, 'printer_id')->dropDownList(User::findUsersByGroup('printer'),['prompt'=>'Нет']) ?>

            <?php echo  $form->field($order, 'rewinder_note')->textarea(['rows' => 1]) ?>

            <?php echo  $form->field($order, 'printer_note')->textarea(['rows' => 1]) ?>

            <?php echo  $form->field($order, 'tech_note')->textarea(['rows' => 1]) ?>

            <?php echo  $form->field($order, 'sleeve_id')->dropDownList(ArrayHelper::map(Sleeve::find()->asArray()->all(), 'id', 'name')) ?>

            <?php echo  $form->field($order, 'winding_id')->dropDownList(ArrayHelper::map(Winding::find()->asArray()->all(), 'id', 'name')) ?>

            <?php echo  $form->field($order, 'label_on_roll')->textInput() ?>

            <?php echo  $form->field($order, 'cut_edge')->dropDownList([0=>'Нет',1=>'Да']) ?>

            <?php echo  $form->field($order, 'stretch')->dropDownList([0=>'Нет',1=>'Да']) ?>

        </div>
    </div>

    <div class="form-group">
        <?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
