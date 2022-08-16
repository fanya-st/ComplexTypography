<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\User;
use app\models\Pants;
use yii\helpers\ArrayHelper;
use app\models\Polymer;
use app\models\Envelope;
use yii\grid\GridView;
use kartik\select2\Select2;

$this->title = Html::encode("Флексоформы ID [$cur_label->id] $cur_label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$cur_label->id.'] '.$cur_label->name, 'url' => ['label/view','id'=>$cur_label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?$form = ActiveForm::begin()?>
    <h3><?= Html::encode($this->title)?></h3>
    <h6>Флексоформы выполнил: <?=User::getFullNameByUsername($cur_label->laboratory_login)?></h6>
    <h6>Штанец №: <?=Pants::findOne($cur_label->pants_id)->name?></h6>
    <h6>Совмещение (ID этикеток): <?foreach ($cur_label->combinatedLabel as $label_id) echo '<span class=" badge rounded-pill bg-primary">'.$label_id.'</span>'?> </h6>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <?=$form->field($flexform,'polymer_id')->dropDownList(ArrayHelper::map(Polymer::find()->all(), 'id',
                        'name'))?>
                </div>
                <div class="col">
<!--                    --><?//=$form->field($flexform,'envelope_id')->dropDownList(ArrayHelper::map(Envelope::find()->all(), 'id',
//                        'fullLocationName'))?>
                    <?=$form->field($flexform,'envelope_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Envelope::find()->all(), 'id', 'fullLocationName'),
                        'options' => ['placeholder' => 'Выберите конверт...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])?>
                    <?=$form->field($envelope,'new_checkbox')->checkbox()?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <?=$form->field($envelope,'rack_id')->dropDownList(ArrayHelper::map(Envelope::$location['rack'],'id','name'),
                    [
                            'prompt' => 'Выберите...'
                        ])?>
                </div>
                <div class="col">
                    <?=$form->field($envelope,'shelf_id')->dropDownList(ArrayHelper::map(Envelope::$location['shelf'],'id','name'),
                    [
                            'prompt' => 'Выберите...'
                        ])?>

                </div>
            </div>
        </div>
        <h6>Список форм:</h6>
        <?echo GridView::widget([
            'dataProvider' => $forms,
            'columns' => [
                'id',
                'pantone.name',
                'width',
                'height',
                'lpi',
                'dpi',
                'photoOutput.name',
            ]
        ])?>
        <?=$form->field($cur_label,'laboratory_note')->textarea()?>
    </div>
<?=Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>
<!--<pre>--><?//print_r($flexform)?><!--</pre>-->
<!--<pre>--><?//print_r($envelope)?><!--</pre>-->
<!--<pre>--><?//print_r($cur_label->combination)?><!--</pre>-->
<!--<pre>--><?//print_r($order->id)?><!--</pre>-->
