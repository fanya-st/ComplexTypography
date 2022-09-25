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
<?php $form = ActiveForm::begin()?>
    <h3><?php echo  Html::encode($this->title)?></h3>
    <h6>Флексоформы выполнил: <?php echo User::getFullNameById($cur_label->laboratory_id)?></h6>
    <h6>Штанец №: <?php echo Pants::findOne($cur_label->pants_id)->name?></h6>
    <h6>Совмещение (ID этикеток): <?php foreach ($cur_label->combinatedLabel as $label_id) echo '<span class=" badge rounded-pill bg-primary">'.$label_id.'</span>'?> </h6>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <?php echo $form->field($flexform,'polymer_id')->dropDownList(ArrayHelper::map(Polymer::find()->all(), 'id',
                        'name'))?>
                </div>
                <div class="col">
                    <?php echo $form->field($flexform,'envelope_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Envelope::find()->all(), 'id', 'id'),
                        'options' => ['placeholder' => 'Выберите конверт...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'data'=>true
                        ],
                    ])?>
                </div>
            </div>
        </div>
        <div class="col">
        </div>
        <h6>Список форм:</h6>
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
            ]
        ])?>
        <?php echo $form->field($cur_label,'laboratory_note')->textarea()?>
    </div>
<?php echo Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?php ActiveForm::end()?>

