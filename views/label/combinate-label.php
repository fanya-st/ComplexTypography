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
    <strong>Внимание!</strong> Если будет произведено совмещение, </a>.
</div>
<?$form = ActiveForm::begin()?>
<div class="row">
<!--    <pre>--><?//print_r($new_combination_form)?><!--</pre>-->
    <div class="col">
        <?=$form->field($new_combination_form,'label_id')->widget(Select2::classname(), [
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
    </div>
</div>

<?=Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>