<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\LabelStatus;
use yii\helpers\ArrayHelper;
use app\models\Customer;
use kartik\select2\Select2;
use app\models\User;

$this->title = Html::encode("Редактирование ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $label->name, 'url' => ['label/view','id'=>$label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?$form = ActiveForm::begin()?>
<h3><?= Html::encode($this->title)?><?=Html::submitButton('Сохранить',['class'=>'btn btn-success'])?></h3>
<div class="row">
    <div class="col">
        <?= Html::a(Html::img($label->image_crop, ['alt' => $this->title,'width'=>'500px']),$label->image,['target'=>'_blank'])?>
        <div class="row">
            <div class="col">
                <?=$form->field($label,'laminate')->checkbox()?>
                <?=$form->field($label,'stencil')->checkbox()?>
            </div>
            <div class="col">
                <?=$form->field($label,'variable')->checkbox()?>
                <?=$form->field($label,'print_on_glue')->checkbox()?>
            </div>
        </div>
    </div>
    <div class="col">
        <?=$form->field($label,'name')?>
        <div class="row">
            <div class="col">
                <?=$form->field($label,'customer_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Customer::find()->all(), 'id', 'name'),
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ])?>
                <?=$form->field($label,'designer_id')
                    ->dropDownList(User::findUsersByGroup('designer'))?>
            </div>
            <div class="col">
                <?=$form->field($label,'status_id')
                    ->dropDownList(LabelStatus::$label_status,['disabled'=>true])?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?=$form->field($label,'pants_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'name'),
                    'pluginOptions' => [
                        'allowClear' =>false
                    ],
                ])?>
                <?=$form->field($label,'foil_id')
                    ->dropDownList(ArrayHelper::map(Foil::find()->all(), 'id', 'name'))?>
                <?=$form->field($label,'orientation')->dropDownList([
                    '0' => 'Не указана',
                    '1' => 'Альбомная',
                    '2'=>'Книжная'
                ])?>
            </div>
            <div class="col">
                <?=$form->field($label,'varnish_id')
                    ->dropDownList(ArrayHelper::map(VarnishStatus::find()->all(), 'id', 'name'))?>
                <?=$form->field($label,'background_id')->dropDownList(ArrayHelper::map(BackgroundLabel::find()->all(), 'id',
                    'name'))?>
                <?=$form->field($label,'color_count')?>
            </div>
        </div>
        <?=$form->field($label,'output_label_id')->radioList(ArrayHelper::map(OutputLabel::find()->all(),'id', 'name'),[
            'item' => function ($index, $label, $name, $checked, $value) {
                return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value])." $value ".Html::img(OutputLabel::findOne($value)->image, ['width'=>'100px']) . '</label>';
            }
        ])?>
    </div>
</div>
<div class="row">
    <div class="col">
        <?=$form->field($label,'designer_note')->textarea()?>
    </div>
    <div class="col">
        <?=$form->field($label,'manager_note')->textarea()?>
    </div>
    <div class="col">
        <?=$form->field($label,'prepress_note')->textarea()?>
    </div>
</div>
<?ActiveForm::end()?>