<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\User;
use app\models\Pants;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Pantone;
use app\models\PhotoOutput;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\models\Foil;
use app\models\Label;
use app\models\VarnishStatus;
use app\models\CombinationForm;

$this->title = Html::encode("Prepress готов ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $label->name, 'url' => ['label/view','id'=>$label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= Html::encode($this->title)?></h3>
<div class="alert alert-info">
    <strong>Внимание!</strong> Если будет произведено совмещение, то будут созданы трафаретная форма, лаковая, для фольги, если в одном из выбранных этикеток в параметрах отмечено их наличие</a>.
</div>
<h6>Prepress выполнил: <?=User::getFullNameByUsername($label->prepress_login)?></h6>
<h6>Штанец №: <?=Pants::findOne($label->pants_id)->name?></h6>
<?$form = ActiveForm::begin()?>
    <div class="row">
                <div class="col">
                    <?=$form->field($prepress,'prepress_pantone_list')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Pantone::find()->all(), 'id', 'name'),
                        'options'=>[
                            'placeholder' => 'Выберите CMYK и пантоны ...',
                    'multiple' => true,
                        ]
                    ])?>
                    <?=$form->field($prepress,'combination_label')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Label::find()
                            ->joinWith('combination')
                            ->where(['status_id'=>6,'prepress_login'=>Yii::$app->user->identity->username])
                            ->andWhere(['!=', 'label.id',$label->id])
                            ->andWhere(['not in', 'label.id',CombinationForm::find()->select('label_id')->column()])
                            ->orderBy('date_of_design DESC')
                            ->all(), 'id', 'nameSplitId'),
                        'options'=>[
                            'placeholder' => 'Выберите этикетки для совмещения ...',
                            'multiple' => true,
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])?>
                    <?=$form->field($prepress,'width')?>
                    <?=$form->field($prepress,'height')?>
                    <?=$form->field($prepress,'set_form_count')?>
                </div>
                <div class="col">
                            <?=$form->field($label,'foil_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(Foil::find()->all(), 'id', 'name'),
                                'options'=>[
                                ],
                                'disabled' => true
                            ])?>
<!--                    --><?//if ($label->foil_id!=1) echo $form->field($prepress,'foil_width')
//                        ->label('Ширина фольги, мм (ширина бумаги штанца '.Pants::findOne($label->pants_id)
//                                ->paper_width.', мм)')?>
                    <?=$form->field($prepress,'lpi')->input('integer')?>
                    <?=$form->field($label,'varnish_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(VarnishStatus::find()->all(), 'id', 'name'),
                        'options'=>[
                        ],
                        'disabled' => true
                    ])?>
                    <?$photo_output_list=ArrayHelper::map(PhotoOutput::find()->all(), 'id', 'name')?>
                    <?=$form->field($prepress,'photo_output_id')
                        ->dropDownList($photo_output_list,['id'=>'dpi-id','prompt' => 'Выберите...'])
                    ?>
                    <?=$form->field($prepress,'dpi')->widget(DepDrop::classname(), [
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                            'allowClear' => true,
                            'depends'=>['dpi-id'],
                            'placeholder'=>'Выберите DPI...',
                            'url'=>Url::to(['/label/subdpi'])
                        ]
                    ])?>
                </div>
        <?=$form->field($label,'stencil')->checkbox(['disabled' =>true])?>
        <?=$form->field($prepress_file,'prepress_design_file_file')->FileInput()?>
        <?=$form->field($label,'prepress_note')->textarea()?>
    </div>

<?=Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>
<!--<pre>--><?//print_r(Label::find()->select('foil_id')->where(['id' => $prepress->combination_label])->column())?><!--</pre>-->
<!--<pre>--><?// var_dump(!ArrayHelper::isIn(1,Label::find()->select('foil_id')->where(['id' => $prepress->combination_label])->column()))?><!--</pre>-->
<!--<pre>--><?//print_r($pantone_list)?><!--</pre>-->
<!--<pre>--><?//print_r($label)?><!--</pre>-->
<!--<pre>--><?//print_r($label->prepress_design_file_file)?><!--</pre>-->
