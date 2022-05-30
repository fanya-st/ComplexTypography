<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use kartik\select2\Select2;
use app\models\Customer;
use yii\helpers\ArrayHelper;
use app\models\Shaft;
use app\models\Pants;

$this->title = 'Создание заказа с "готовой" этикеткой';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказами', 'url' => ['order/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-info">
        <strong>Внимание!</strong> Этикетка будет создана "на лету" со статусом - готовая</a>.
    </div>
	<?$form = ActiveForm::begin()?>
    <div class="row">
        <div class="col">
            <?=$form->field($label,'name')->textInput()?>
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
                    <?=$form->field($label,'shaft_id')
                        ->dropDownList(ArrayHelper::map(Shaft::find()->all(), 'id',
                            'name'), [
                            'prompt' => 'Выберите...'
                        ])?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">

                </div>
                <div class="col">

                </div>
            </div>
        </div>
    </div>
    <?=$form->field($label, 'manager_login')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false);?>
    <?=$form->field($label, 'status_id')->hiddenInput(['value' => 11])->label(false);?>
    <?=$form->field($label, 'embossing')->hiddenInput(['value' => 0])->label(false);?>
    <?=$form->field($label, 'output_label_id')->hiddenInput(['value' => 1])->label(false);?>
    <?=$form->field($label, 'background_id')->hiddenInput(['value' => 1])->label(false);?>
    <?=$form->field($label, 'print_on_glue')->hiddenInput(['value' => 0])->label(false);?>
    <?=$form->field($label, 'varnish_id')->hiddenInput(['value' => 0])->label(false);?>
    <?=$form->field($label, 'variable')->hiddenInput(['value' => 0])->label(false);?>
    <?=$form->field($label, 'stencil')->hiddenInput(['value' => 0])->label(false);?>
    <?=$form->field($label, 'laminate')->hiddenInput(['value' => 0])->label(false);?>
    <?=$form->field($label, 'blank')->hiddenInput(['value' => 1])->label(false);?>
	<?=Html::submitButton('Создать этикетку',['class'=>'btn btn-success'])?>
	<?ActiveForm::end()?>