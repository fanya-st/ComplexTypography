<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\User;
use app\models\Pants;
use yii\helpers\ArrayHelper;
use app\models\Polymer;
use yii\grid\GridView;

$this->title = Html::encode("Флексоформы ID [$label->id] $label->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $label->name, 'url' => ['label/view','id'=>$label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?$form = ActiveForm::begin()?>
    <h3><?= Html::encode($this->title)?></h3>
    <h6>Флексоформы выполнил: <?=User::getFullNameByUsername($label->laboratory_login)?></h6>
    <h6>Штанец №: <?=Pants::findOne($label->pants_id)->name?></h6>
    <h6>Совмещение (ID этикеток): <?foreach ($label->combinatedLabel as $label_id) echo '<span class="badge rounded-pill bg-primary">'.$label_id.'</span>'?> </h6>
    <div class="row">
        <div class="col">
            <?=$form->field($flexform,'polymer_id')->dropDownList(ArrayHelper::map(Polymer::find()->all(), 'id',
                'name'))?>
        </div>
        <div class="col"></div>
        <h6>Список форм:</h6>
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
            ]
        ])?>
        <?=$form->field($label,'laboratory_note')->textarea()?>
    </div>
<?=Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?ActiveForm::end()?>