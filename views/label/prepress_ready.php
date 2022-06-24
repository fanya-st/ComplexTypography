<?php
use yii\bootstrap5\Html;
use app\models\User;
use app\models\Pants;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Pantone;
use app\models\PhotoOutput;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\icons\Icon;
Icon::map($this, Icon::FA);

$this->title = Html::encode("Prepress готов ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $label->name, 'url' => ['label/view','id'=>$label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= Html::encode($this->title)?></h3>
<div class="alert alert-info">
    <strong>Внимание!</strong> Если этикетка совмещена, то новые формы будут общие для всех этикеток в совмещении</a>.
</div>
<h6>Prepress выполнил: <?=User::getFullNameByUsername($label->prepress_login)?></h6>
<h6>Штанец №: <?=Pants::findOne($label->pants_id)->name?></h6>
<!--<pre>--><?//print_r($new_form)?><!--</pre>-->
<?
$form = ActiveForm::begin();
?>
<div class="row g-2 row-cols-1">
    <div class="col">
        <div class="row">
            <div class="col">
                <?=$form->field($new_form,'pantone_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Pantone::find()->all(), 'id', 'name'),
                    'options'=>[
                        'placeholder' => 'Выберите CMYK и пантоны ...',
                    ]
                ])?>
                <?=$form->field($new_form,'width')?>
                <?=$form->field($new_form,'height')?>
                <?$photo_output_list=ArrayHelper::map(PhotoOutput::find()->all(), 'id', 'name')?>
                <?=$form->field($new_form,'photo_output_id')
                    ->dropDownList($photo_output_list,['id'=>'dpi-id','prompt' => 'Выберите...'])
                ?>
                <?=Html::submitButton('Добавить новую форму',['name'=>'add','class'=>'btn btn-success'])?>
            </div>
            <div class="col">
                <?=$form->field($new_form,'lpi')->input('integer')?>
                <?=$form->field($new_form,'set_form_count')?>
                <?=$form->field($new_form,'foil_stencil_varnish',['inline'=>true])->radioList([0=>'Нет','varnish_form'=>'Лаковая форма',
                    'foil_form'=>'Фольга','stencil_form'=>'Трафарет'])->label('Фольга, трафарет или лак?')?>
                <?=$form->field($new_form,'dpi')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'pluginOptions'=>[
                        'allowClear' => true,
                        'depends'=>['dpi-id'],
                        'placeholder'=>'Выберите DPI...',
                        'url'=>Url::to(['/label/subdpi'])
                    ]
                ])?>
            </div>
        </div>
    </div>
    <div class="col">
        <?echo GridView::widget([
            'dataProvider' => $forms,
            'columns' => [
                'id',
                'pantoneName',
                'width',
                'height',
                'lpi',
                'dpi',
                'photoOutput.name',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{delete}',
                    'buttons' => ['delete' => function($url, $model){
                        return Html::a('<span class="fa fa-trash"></span>', ['prepress-delete-form', 'form_id' => $model->id], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'ВЫ уверены?',
                                'method' => 'post',
                            ],
                        ]);
                    }],
                ],
            ]
        ])?>
    </div>
</div>
<? ActiveForm::end()?>
<? $form=ActiveForm::begin()?>
<div class="row">
    <?=$form->field($prepress_file,'prepress_design_file_file')->FileInput()?>
    <?=$form->field($label,'prepress_note')->textarea()?>
    <?=Html::submitButton('Завершить Препресс',['name'=>'finish_prepress','class'=>'btn btn-success'])?>
</div>
<? ActiveForm::end()?>
<div class="row">

</div>
