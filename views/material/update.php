<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\MaterialGroup;
use app\models\MaterialProvider;
use yii\helpers\ArrayHelper;

$this->title = Html::encode("Редактирование ID [$material->id] $material->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с материалами', 'url' => ['material/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?php echo  Html::encode($this->title) ?></h2>
<!--<pre>--><?php //print_r(Yii::$app->request->post())?><!--</pre>-->
<?php $form = ActiveForm::begin()?>
    <div class="border p-3 rounded">
    <div class="row">
        <div class="col">
            <?php echo $form->field($material,'name')->textInput()?>
            <?php echo $form->field($material,'material_group_id')->dropDownList(ArrayHelper::map(MaterialGroup::find()->asArray()->all(), 'id', 'name'))?>
            <?php echo $form->field($material,'material_provider_id')->dropDownList(ArrayHelper::map(MaterialProvider::find()->asArray()->all(), 'id', 'name'))?>
            <?php echo $form->field($material,'price_euro')->textInput()?>
            <?php echo $form->field($material,'density')->textInput()?>
        </div>
        <div class="col">
            <?php echo $form->field($material,'short_name')->textInput()?>
            <?php echo $form->field($material,'prompt')->textInput()?>
            <?php echo $form->field($material,'status')->dropDownList([0=>'В архиве',1=>'Активный'])?>
            <?php echo $form->field($material,'material_id_from_provider')->textInput()?>
        </div>
    </div>
        <?php echo Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
    </div>
<?php ActiveForm::end() ?>