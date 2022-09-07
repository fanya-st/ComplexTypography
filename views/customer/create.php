<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\label\LabelInPlace;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Subject;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\time\TimePicker;


$this->title = 'Добавление заказчика';
$this->params['breadcrumbs'][] = ['label' => 'Работа с заказчиками', 'url' => ['customer/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?$form = ActiveForm::begin()?>
<div class="row">
    <div class="col">
        <?=$form->field($customer,'name')
            ->widget(LabelInPlace::class,[
                'type' => LabelInPlace::TYPE_HTML5,
                'options' => ['type' => 'text']
            ])
        ?>
        <?=$form->field($customer,'email')
            ->widget(LabelInPlace::class,[
                'type' => LabelInPlace::TYPE_HTML5,
                'options' => ['type' => 'email']
            ])
        ?>
        <?=$form->field($customer,'number')
            ->widget(LabelInPlace::class,[
                'type' => LabelInPlace::TYPE_HTML5,
                'options' => ['type' => 'text']
            ])
        ?>
        <?=$form->field($customer,'date_of_agreement')->widget(DatePicker::class, [
            'options' => ['placeholder' => 'Введите дату договора ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'autoClose' => true,
                'format' => 'yyyy-mm-dd',
            ]
        ])->label(false)?>
        <?=$form->field($customer, 'time_to_delivery_from')->widget(TimePicker::class, [
            'pluginOptions'=>[
                'showMeridian'=>false,
            ]
        ]) ?>
        <?=$form->field($customer, 'time_to_delivery_to')->widget(TimePicker::classname(), [
            'pluginOptions'=>[
                'showMeridian'=>false,
            ]
        ]) ?>
        <?=Html::submitButton('Добавить заказчика',['class'=>'btn btn-success'])?>
    </div>
    <div class="col">
        <?=$form->field($customer,'subject_id')
            ->dropDownList(ArrayHelper::map(Subject::find()->asArray()->all(),'id','name'),['id'=>'subject-id','prompt' => 'Выберите субьект РФ...'])->label(false)
        ?>
        <?=$form->field($customer,'region_id')->widget(DepDrop::classname(), [
            'type' => DepDrop::TYPE_SELECT2,
            'options'=>['id'=>'region-id'],
            'pluginOptions'=>[
                'allowClear' => true,
                'depends'=>['subject-id'],
                'placeholder'=>'Выберите регион...',
                'url'=>Url::to(['/customer/region'])
            ]
        ])->label(false)?>

        <?=$form->field($customer,'town_id')->widget(DepDrop::classname(), [
            'type' => DepDrop::TYPE_SELECT2,
            'options'=>['id'=>'town-id'],
            'pluginOptions'=>[
                'allowClear' => true,
                'depends'=>['region-id'],
                'placeholder'=>'Выберите город и т.д ...',
                'url'=>Url::to(['/customer/town'])
            ]
        ])->label(false)?>

        <?=$form->field($customer,'street_id')->widget(DepDrop::classname(), [
            'type' => DepDrop::TYPE_SELECT2,
            'pluginOptions'=>[
                'allowClear' => true,
                'depends'=>['town-id'],
                'placeholder'=>'Выберите улицу...',
                'url'=>Url::to(['/customer/street'])
            ]
        ])->label(false)?>
        <?=$form->field($customer,'house')
            ->widget(LabelInPlace::classname(),[
                'type' => LabelInPlace::TYPE_HTML5,
                'options' => ['type' => 'text'],
            ])
        ?>
        <?=$form->field($customer,'contact')
            ->widget(LabelInPlace::class,[
                'type' => LabelInPlace::TYPE_HTML5,
                'options' => ['type' => 'text'],
            ])
        ?>
        <?=$form->field($customer, 'comment')->widget(LabelInPlace::classname(), [
            'type' => LabelInPlace::TYPE_TEXTAREA
        ])?>
    </div>
</div>
<?ActiveForm::end()?>