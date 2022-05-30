<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\ActiveField;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
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
<div class="row">
    <div class="col">
        <?=$form->field($model,'name')?>
        <?=$form->field($model,'customer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1','manager_login'=>Yii::$app->user->identity->username])->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать заказчика ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])?>
<!--        <div class="form-check">-->
<!--            <p>--><?//=$model->getAttributeLabel('output_label_id')?><!--</p>-->
<!--            <input type="radio" class="form-check-input" value="1" name="output_label_id" id="option1" autocomplete="off" required>-->
<!--            <label class="form-check-label" for="option1">--><?//=Html::img(OutputLabel::findOne(1)->image, ['width'=>'100px'])?><!--</label>-->
<!--            <input type="radio" class="form-check-input" value="2" name="output_label_id" id="option2" autocomplete="off">-->
<!--            <label class="form-check-label" for="option2">--><?//=Html::img(OutputLabel::findOne(2)->image, ['width'=>'100px'])?><!--</label>-->
<!--            <input type="radio" class="form-check-input" value="3" name="output_label_id" id="option3" autocomplete="off">-->
<!--            <label class="form-check-label" for="option3">--><?//=Html::img(OutputLabel::findOne(3)->image, ['width'=>'100px'])?><!--</label>-->
<!--            <input type="radio" class="form-check-input" value="4" name="output_label_id" id="option4" autocomplete="off">-->
<!--            <label class="form-check-label" for="option4">--><?//=Html::img(OutputLabel::findOne(4)->image, ['width'=>'100px'])?><!--</label>-->
<!--        </div>-->
        <?=$form->field($model,'output_label_id')->radioList(ArrayHelper::map(OutputLabel::find()->all(),'id', 'name'),[
            'item' => function ($index, $label, $name, $checked, $value) {
                return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value])." $value ".Html::img(OutputLabel::findOne($value)->image, ['width'=>'100px']) . '</label>';
            }
        ])?>
<!--        --><?//=$form->field($model,'output_label_id')
//            ->radioList(ArrayHelper::map(OutputLabel::find()->all(),'id', 'name'))
//        ?>
        <?=$form->field($model,'manager_note')->textarea()?>
        <?=$form->field($model, 'manager_login')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false);?>
        <?=Html::submitButton('Создать этикетку',['class'=>'btn btn-success'])?>
    </div>
    <div class="col">
        <div class="row">
            <div class="col">
                <?=$form->field($model,'pants_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Выбрать штанец ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
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
                <?=$form->field($model,'embossing')->dropDownList([
                    '0' => 'Нет',
                    '1' => 'Да',
                ], [
                    'prompt' => 'Выберите...'
                ])?>
            </div>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?=$form->field($label, 'blank')->hiddenInput(['value' => 0])->label(false);?>
<?ActiveForm::end()?>
