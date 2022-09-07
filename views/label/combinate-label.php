<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Label;
use app\models\CombinationForm;

$this->title = Html::encode("Совмещение этикеток ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $label->name, 'url' => ['label/view','id'=>$label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= Html::encode($this->title)?></h3>
<div class="alert alert-info">
    <strong>Внимание!</strong> Будет произведено совмещение</a>.
</div>
<?$form = ActiveForm::begin()?>
<div class="row">
    <div class="col">
        <?=$form->field($label,'combinated_label_list')->widget(Select2::class, [
            'data' => ArrayHelper::map(Label::find()
                ->joinWith('combination')
                ->where(['status_id'=>6,'prepress_id'=>Yii::$app->user->identity->getId()])
                ->andWhere(['!=', 'label.id',$label->id])
                ->andWhere(['not in', 'label.id',CombinationForm::find()->select('label_id')->column()])
                ->orderBy('date_of_design DESC')
                ->all(), 'id', 'nameSplitId'),
            'options'=>[
                'placeholder' => ' Выберите этикетки для совмещения ...',
                'multiple' => true,
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Этикетки')?>
    </div>
</div>

<?=Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>
