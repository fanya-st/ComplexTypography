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

$this->title = Html::encode("Prepress готов ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $label->name, 'url' => ['label/view','id'=>$label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?$form = ActiveForm::begin()?>
    <h3><?= Html::encode($this->title)?></h3>
    <div class="row">
        <div class="col">
            <h6>Prepress выполнил: <?=User::getFullNameByUsername($label->prepress_login)?></h6>
            <h6>Штанец №: <?=Pants::findOne($label->pants_id)->name?></h6>
            <div class="row">
                <div class="col">
                    <?=$form->field($label,'prepress_pantone_list')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Pantone::find()->all(), 'id', 'name'),
                        'options'=>[
                            'placeholder' => 'Выберите CMYK и пантоны ...',
                    'multiple' => true,
                        ]
                    ])?>
                    <?=$form->field($label,'lineature')?>
                    <?=$form->field($label,'foil_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Foil::find()->all(), 'id', 'name'),
                        'options'=>[
                        ]
                    ])?>
                </div>
                <div class="col">
                    <?=$form->field($label,'set_form_count')?>
                    <?=$form->field($label,'form_width')?>
                    <?=$form->field($label,'form_height')?>

                </div>
            </div>

            <?
            if($label->varnish_id!=0)
                echo $form->field($label,'varnish_check')->checkbox(['checked ' => true]);
            else
                echo $form->field($label,'varnish_check')->checkbox();
            ?>

            <?
            if($label->stencil!=0)
                echo $form->field($label,'stencil_check')->checkbox(['checked ' => true]);
            else
                echo $form->field($label,'stencil_check')->checkbox();
            ?>
            <?$photo_output_list=ArrayHelper::map(PhotoOutput::find()->all(), 'id', 'name')?>
            <?=$form->field($label,'photo_output_id')
                ->dropDownList($photo_output_list,['id'=>'dpi-id','prompt' => 'Выберите...'])
//                ->widget(Select2::classname(), [
//                    'data' => ArrayHelper::map(PhotoOutput::find()->all(), 'id', 'name'),
//                    ['id'=>'dpi-id'],
//                    'options' => ['placeholder' => 'Выбрать фотовывод ...'],
//                ])
            ?>
            <?=$form->field($label,'subdpi')->widget(DepDrop::classname(), [
                'type' => DepDrop::TYPE_SELECT2,
//                'options'=>[],
                'pluginOptions'=>[
                        'allowClear' => true,
                    'depends'=>['dpi-id'],
                    'placeholder'=>'Выберите DPI...',
                    'url'=>Url::to(['/label/subdpi'])
                ]
            ])?>
            <?=$form->field($label,'prepress_file')->FileInput()?>
            <?=$form->field($label,'prepress_note')->textarea()?>
        </div>
        <div class="col">

        </div>
    </div>
<?=Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>
<pre><?print_r($label)?></pre>
