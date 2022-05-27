<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use kartik\select2\Select2;
use app\models\Customer;
use yii\helpers\ArrayHelper;
use app\models\Mashine;
use app\models\Pants;
use kartik\date\DatePicker;
use app\models\Material;
use app\models\Sleeve;
use app\models\Winding;

$this->title = 'Создание заказа с "готовой" этикеткой';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-info">
        <strong>Внимание!</strong> Этикетка будет создана "на лету" со статусом - готовая</a>.
    </div>
	<?$form = ActiveForm::begin()?>
    <div class="row">
        <div class="col">
            <?=$form->field($label,'name')?>
            <div class="row">
                <div class="col">
                    <?=$form->field($order,'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->all(), 'id', 'name'), [
                        'prompt' => 'Выберите...'
                    ])?>
                    <?=$form->field($order,'sending')?>
                </div>
                <div class="col">
                    <?=$form->field($order,'date_of_sale')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Введите дату сдачи ...'],
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ])?>
                    <?=$form->field($order,'label_price')?>
                </div>
            </div>
            <?=$form->field($order,'material_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Material::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Выбрать материал ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])?>
            <?=$form->field($order,'winding_id')->radioList(ArrayHelper::map(Winding::find()->all(),'id', 'name'),[
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value]) . Html::img(Winding::findOne($value)->image, ['width'=>'100px']) . '</label>';
                }
            ])?>
            <?=$form->field($order,'rewinder_note')->textarea()?>
        </div>
        <div class="col">
            <?=$form->field($label,'customer_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1','manager_login'=>Yii::$app->user->identity->username])->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Выбрать заказчика ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])?>
            <div class="row">
                <div class="col">
                    <?=$form->field($label,'pants_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Выбрать штанец ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])?>
                    <?=$form->field($order,'trial_circulation')->dropDownList([
                        '0' => 'Нет',
                        '1' => 'Да'
                    ],
                        [
                            'prompt' => 'Выберите...'
                        ])?>
                    <?=$form->field($order,'sleeve_id')->dropDownList(ArrayHelper::map(Sleeve::find()->all(), 'id', 'name'),
                        [
                            'prompt' => 'Выберите...'
                        ])?>
                    <?=$form->field($order,'cut_edge')->dropDownList([
                        '0' => 'Не срезать',
                        '1' => 'Срезать',
                    ],
                        [
                            'prompt' => 'Выберите...'
                        ])?>
                    <?=$form->field($order,'stretch')->dropDownList([
                        '0' => 'Нет',
                        '1' => 'Да',
                    ],
                        [
                            'prompt' => 'Выберите...'
                        ])?>
                </div>
                <div class="col">
                    <?=$form->field($label,'orientation')->dropDownList([
                        '0' => 'Не указана',
                        '1' => 'Альбомная',
                        '2'=>'Книжная'
                    ],
                        [
                            'prompt' => 'Выберите...'
                        ])?>
                    <?=$form->field($order,'plan_circulation')?>
                    <?=$form->field($order,'diameter_roll')?>
                    <?=$form->field($order,'label_on_roll')?>
                </div>
            </div>
        </div>
    </div>
    <?=$form->field($order, 'manager_login')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false);?>
    <?=$form->field($order, 'status')->hiddenInput(['value' => 1])->label(false);?>
	<?=Html::submitButton('Создать заказ',['class'=>'btn btn-success'])?>
	<?ActiveForm::end()?>