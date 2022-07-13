<?php


use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\MaterialGroup;
use app\models\MaterialProvider;
use yii\helpers\ArrayHelper;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

$this->title = Html::encode("Редактирование ID [$material->id] $material->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с материалами', 'url' => ['material/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?></h2>
<!--<pre>--><?//print_r(Yii::$app->request->post())?><!--</pre>-->
<?php $form = ActiveForm::begin()?>
    <div class="border p-3 rounded">
    <div class="row">
        <div class="col">
            <?=$form->field($material,'name')->textInput()?>
            <?=$form->field($material,'material_group_id')->dropDownList(ArrayHelper::map(MaterialGroup::find()->asArray()->all(), 'id', 'name'))?>
            <?=$form->field($material,'material_provider_id')->dropDownList(ArrayHelper::map(MaterialProvider::find()->asArray()->all(), 'id', 'name'))?>
            <?=$form->field($material,'price_euro')->textInput()?>
            <?=$form->field($material,'price_euro_discount')->textInput()?>
            <?=$form->field($material,'density')->textInput()?>
        </div>
        <div class="col">
            <?=$form->field($material,'short_name')->textInput()?>
            <?=$form->field($material,'prompt')->textInput()?>
            <?=$form->field($material,'status')->dropDownList([0=>'В архиве',1=>'Активный'])?>
            <?=$form->field($material,'price_rub')->textInput()?>
            <?=$form->field($material,'price_rub_discount')->textInput()?>
        </div>
    </div>
        <?=Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
    </div>
<?php ActiveForm::end() ?>