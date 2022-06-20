<?php

use yii\bootstrap5\ActiveForm;
use app\models\Shaft;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\Html;
use app\models\Customer;
use kartik\select2\Select2;
use app\models\Pants;
use app\models\OutputLabel;
use app\models\VarnishStatus;
use app\models\BackgroundLabel;

$this->title = 'Создание этикетки';
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?$form = ActiveForm::begin()?>
<!--<pre>--><?//print_r($model)?><!--</pre>-->
<div class="row">
    <div class="col">
        <?=$form->field($model,'name')?>
        <?=$form->field($model,'customer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1','manager_login'=>Yii::$app->user->identity->username])->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать заказчика ...'],
            'pluginOptions' => [
//                'allowClear' => true
            ],
        ])?>
        <?=$form->field($model,'output_label_id')->radioList(ArrayHelper::map(OutputLabel::find()->all(),'id', 'name'),[
            'item' => function ($index, $label, $name, $checked, $value) {
                return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value])." $value ".Html::img(OutputLabel::findOne($value)->image, ['width'=>'100px']) . '</label>';
            }
        ])?>
        <?//=$form->field($model,'output_label_id')
//            ->radioList(ArrayHelper::map(OutputLabel::find()->all(),'id', 'name'))
//        ?>
        <?=$form->field($model,'manager_note')->textarea()?>
<!--        --><?//=$form->field($model, 'manager_login')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false);?>
        <?=Html::submitButton('Создать этикетку',['class'=>'btn btn-success'])?>
    </div>
    <div class="col">
        <div class="row">
            <div class="col">
                <?=$form->field($model,'pants_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Выбрать штанец ...'],
//                    'pluginOptions' => [
//                        'allowClear' => true
//                    ],
                ])?>
            </div>
            <div class="col">
                <?=$form->field($model,'orientation')->dropDownList([
                    '0' => 'Не указана',
                    '1' => 'Альбомная',
                    '2'=>'Книжная'
                ],
                    [
                    'prompt' => 'Выберите...'
                ])?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?=$form->field($model,'laminate')->dropDownList([
                    '0' => 'Нет',
                    '1' => 'Да',
                ], [
                    'prompt' => 'Выберите...'
                ])?>

                <?=$form->field($model,'takeoff_flash')->dropDownList([
                    '0' => 'Нет',
                    '1' => 'Да',
                ], [
                    'prompt' => 'Выберите...'
                ])?>
            </div>
            <div class="col">
                <div class="col">
                    <?=$form->field($model,'variable')->dropDownList([
                        '0' => 'Нет',
                        '1' => 'Да',
                    ], [
                        'prompt' => 'Выберите...'
                    ])?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="col">
                    <?=$form->field($model,'varnish_id')->dropDownList(ArrayHelper::map(VarnishStatus::find()->all(), 'id',
                        'name'), [
                        'prompt' => 'Выберите...'
                    ])?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?=$form->field($model,'print_on_glue')->dropDownList([
                    '0' => 'Нет',
                    '1' => 'Да',
                ], [
                    'prompt' => 'Выберите...'
                ])?>
                <?=$form->field($model,'stencil')->dropDownList([
                    '0' => 'Нет',
                    '1' => 'Да',
                ], [
                    'prompt' => 'Выберите...'
                ])?>
            </div>
            <div class="col">
                <div class="col">
                    <?=$form->field($model,'background_id')->dropDownList(ArrayHelper::map(BackgroundLabel::find()->all(), 'id',
                        'name'), [
                        'prompt' => 'Выберите...'
                    ])?>

                    <?=$form->field($model,'color_count')?>
                    <?=$form->field($model, 'foil_width')->hiddenInput(['value' => 0])->label(false);?>
                </div>
            </div>
        </div>
    </div>
</div>
<?ActiveForm::end()?>
