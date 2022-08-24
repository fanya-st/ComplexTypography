<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Transport;


$this->title = Html::encode("Данные поездки");
$this->params['breadcrumbs'][] = ['label' => 'Работа с отгрузками', 'url' => ['shipment/list']];
$this->params['breadcrumbs'][] = ['label' => 'Отгрузка', 'url' => ['shipment/view','id'=>$shipment->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<? $form = ActiveForm::begin(['method'=>'post'])?>
<?=$form->field($shipment,'transport_id')->dropDownList(ArrayHelper::map(Transport::find()->asArray()->all(),'id','name'))?>
<?=$form->field($shipment,'gasoline_cost')->textInput()?>
<?=$form->field($shipment,'cost')->textInput()?>
<?=Html::submitButton('Сохранить', ['class'=>'btn btn-primary'])?>
<? ActiveForm::end()?>