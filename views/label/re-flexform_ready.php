<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\User;
use app\models\Pants;
use app\models\Form;
use yii\grid\GridView;

$this->title = Html::encode("Флексоформы перевывод ID [$cur_label->id] $cur_label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => 'ID['.$cur_label->id.'] '.$cur_label->name, 'url' => ['label/view','id'=>$cur_label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin()?>
<h3><?php echo  Html::encode($this->title)?></h3>
<h6>Флексоформы выполнил: <?php echo User::getFullNameById($cur_label->laboratory_id)?></h6>
<h6>Штанец №: <?php echo Pants::findOne($cur_label->pants_id)->name?></h6>
<h6>Совмещение (ID этикеток): <?php foreach ($cur_label->combinatedLabel as $label_id) echo '<span class=" badge rounded-pill bg-primary">'.$label_id.'</span>'?> </h6>
<h6>Конверт №:<?php if (!empty($cur_label->combination->combination_id)):?>
        <?php echo  '<span class="badge rounded-pill bg-primary">'.Html::encode(Form::find()->where(['combination_id'=>$cur_label->combination])
                ->one()->envelope->fullLocationName).'</span>'?>
    <?php else: ?>
        <?php echo  '<span class="badge rounded-pill bg-primary">'.Html::encode(Form::find()->where(['label_id'=>$cur_label->id])->one()->envelope->fullLocationName).'</span>'?>

    <?php endif; ?>
</h6>
<div class="row">
    <div class="col">
    </div>
    <h6>Список форм на перевывод:</h6>
    <?phpecho GridView::widget([
        'dataProvider' => $forms,
        'columns' => [
            'id',
            'pantone.name',
            'formDefect.name',
            'width',
            'height',
            'lpi',
            'dpi',
            'photoOutput.name',
        ]
    ])?>
    <?php echo $form->field($cur_label,'laboratory_note')->textarea()?>
</div>
<?php echo Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?php ActiveForm::end()?>
<!--<pre>--><?php //print_r($forms)?><!--</pre>-->
<!--<pre>--><?php //print_r($envelope)?><!--</pre>-->
<!--<pre>--><?php //print_r($cur_label)?><!--</pre>-->
