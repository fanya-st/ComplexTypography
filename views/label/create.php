<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\Html;
use app\models\Customer;
use kartik\select2\Select2;
use app\models\Pants;
use app\models\OutputLabel;
use app\models\VarnishStatus;
use app\models\BackgroundLabel;
use app\models\Foil;

$this->title = 'Создание этикетки';
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo  Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin()?>
<div class="row">
    <div class="col">
        <?php echo $form->field($model,'name')?>
        <?php echo $form->field($model,'customer_id')->widget(Select2::class, [
            'data' => ArrayHelper::map(Customer::find()->where(['status_id' => '1','user_id'=>Yii::$app->user->identity->getId()])->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выбрать заказчика ...'],
            'pluginOptions' => [
//                'allowClear' => true
            ],
        ])?>
        <div class="row">
            <div class="col">
                <?php echo $form->field($model,'pants_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'id'),
                    'options' => ['placeholder' => 'Выбрать штанец ...'],
                ])?>
            </div>
            <div class="col">
                <?php echo $form->field($model,'orientation')->dropDownList([
                    '0' => 'Не указана',
                    '1' => 'Альбомная',
                    '2'=>'Книжная'
                ])?>
            </div>
        </div>
        <?php echo $form->field($model,'output_label_id')->radioList(ArrayHelper::map(OutputLabel::find()->all(),'id', 'name'),[
            'item' => function ($index, $label, $name, $checked, $value) {
                return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value])." $value ".Html::img(OutputLabel::findOne($value)->image, ['width'=>'100px']) . '</label>';
            }
        ])?>
        <?php echo $form->field($model,'manager_note')->textarea()?>

        <?php echo Html::submitButton('Создать этикетку',['class'=>'btn btn-success'])?>
    </div>
    <div class="col">
        <div class="row">
            <div class="col">
                <?php echo $form->field($model,'laminate')->dropDownList([
                    '0' => 'Нет',
                    '1' => 'Да',
                ])?>

                <?php echo $form->field($model,'takeoff_flash')->dropDownList([
                    '0' => 'Нет',
                    '1' => 'Да',
                ])?>
                <?php echo $form->field($model,'print_on_glue')->dropDownList([
                    '0' => 'Нет',
                    '1' => 'Да',
                ])?>
                <?php echo $form->field($model,'stencil')->dropDownList([
                    '0' => 'Нет',
                    '1' => 'Да',
                ])?>

                <?php echo $form->field($model,'foil_id')->dropDownList(
                    ArrayHelper::map(Foil::find()->all(), 'id',
                        'name'))?>
            </div>
            <div class="col">
                <?php echo $form->field($model,'variable')->dropDownList([
                    '0' => 'Нет',
                    '1' => 'Да',
                ])?>
                <?php echo $form->field($model,'varnish_id')->dropDownList(ArrayHelper::map(VarnishStatus::find()->all(), 'id',
                    'name'))?>
                <?php echo $form->field($model,'background_id')->dropDownList(ArrayHelper::map(BackgroundLabel::find()->all(), 'id',
                    'name'))?>

                <?php echo $form->field($model,'color_count')?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end()?>
