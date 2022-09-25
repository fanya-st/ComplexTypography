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

$this->title = Html::encode("Prepress готов ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $label->name, 'url' => ['label/view','id'=>$label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?php echo  Html::encode($this->title)?></h3>
<div class="alert alert-info">
    <strong>Внимание!</strong> Если этикетка совмещена, то новые формы будут общие для всех этикеток в совмещении</a>.
</div>
<h6>Prepress выполнил: <?php echo User::getFullNameById($label->prepress_id)?></h6>
<h6>Штанец №: <?php echo Pants::findOne($label->pants_id)->name?></h6>
<h6>Пантоны: <?php foreach ($label->pantone as $pantone) {
        switch($pantone->name){
            case 'cyan':
                echo '<span class="badge rounded-pill bg-info">'.Html::encode($pantone->name).'</span>';
                break;
            case 'magenta':
                echo '<span class="badge rounded-pill bg-danger">'.Html::encode($pantone->name).'</span>';
                break;
            case 'yellow':
                echo '<span class="badge rounded-pill bg-warning">'.Html::encode($pantone->name).'</span>';
                break;
            case 'black':
                echo '<span class="badge rounded-pill bg-black">'.Html::encode($pantone->name).'</span>';
                break;
            default:
                echo '<span class="badge rounded-pill bg-primary">'.Html::encode($pantone->name).'</span>';
                break;
        }

    }
    ?></h6>
<h6>Фольга: <?php echo $label->foil->name?></h6>
<h6>Лак: <?php echo $label->varnishStatus->name?></h6>
<h6>Трафарет: <?php
    switch($label->stencil){
        case 1: echo 'Да';
        break;
        case 0: echo 'Нет';
        break;
    }
    ?></h6>
<?php
$form = ActiveForm::begin();
?>
<div class="row g-2 row-cols-1">
    <div class="col">
        <div class="row">
            <div class="col">
                <?php echo $form->field($new_form,'pantone_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Pantone::find()->all(), 'id', 'name'),
                    'options'=>[
                        'placeholder' => 'Выберите CMYK и пантоны ...',
                    ]
                ])?>
                <?php echo $form->field($new_form,'width')?>
                <?php echo $form->field($new_form,'height')?>
                <?php $photo_output_list=ArrayHelper::map(PhotoOutput::find()->all(), 'id', 'name')?>
                <?php echo $form->field($new_form,'photo_output_id')
                    ->dropDownList($photo_output_list,['id'=>'dpi-id','prompt' => 'Выберите...'])
                ?>
                <?php echo Html::submitButton('Добавить новую форму',['name'=>'add','class'=>'btn btn-success'])?>
            </div>
            <div class="col">
                <?php echo $form->field($new_form,'lpi')->input('integer')?>
                <?php echo $form->field($new_form,'set_form_count')?>
<!--                --><?php //=$form->field($new_form,'foil_stencil_varnish',['inline'=>true])->radioList(['pantone'=>'Пантон','varnish_form'=>'Лаковая форма',
//                    'foil_form'=>'Фольга','stencil_form'=>'Трафарет'])->label('Фольга, трафарет или лак?')?>
                <?php echo $form->field($new_form,'dpi')->widget(DepDrop::classname(), [
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
        <?phpecho GridView::widget([
            'dataProvider' => $forms,
            'columns' => [
                'id',
                'pantone.name',
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
<?php ActiveForm::end()?>
<?php $form=ActiveForm::begin()?>
<div class="row">
    <?php echo $form->field($prepress_file,'prepress_design_file_file')->FileInput()?>
    <?php echo $form->field($label,'prepress_note')->textarea()?>
    <?php echo Html::submitButton('Завершить Препресс',['name'=>'finish_prepress','class'=>'btn btn-success'])?>
</div>
<?php ActiveForm::end()?>
<div class="row">

</div>
