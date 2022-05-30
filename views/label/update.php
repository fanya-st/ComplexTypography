<?php
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use app\models\LabelStatus;
use yii\helpers\ArrayHelper;
use app\models\Customer;
use kartik\select2\Select2;
use app\models\Pants;
use app\models\Shaft;
use app\models\User;
use app\models\Foil;

$this->title = Html::encode("Редактирование ID [$label->id] $label->name");
$this->params['breadcrumbs'][] = ['label' => 'Работа с этикетками', 'url' => ['label/list']];
$this->params['breadcrumbs'][] = ['label' => $label->name, 'url' => ['label/view','id'=>$label->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<pre>--><?php //print_r($label->designer_login)?><!--</pre>-->
<!--<pre>--><?php //print_r(Yii::$app->user->identity->username)?><!--</pre>-->
<h3><?= Html::encode($this->title)?></h3>
<?$form = ActiveForm::begin()?>
<div class="row">
    <div class="col"><?= Html::a(Html::img($label->image_crop, ['alt' => $this->title,'width'=>'500px']),$label->image,['target'=>'_blank'])?></div>
    <div class="col">
        <?=$form->field($label,'status_id')
            ->dropDownList(ArrayHelper::map(LabelStatus::find()->all(), 'id', 'name'))?>
        <?=$form->field($label,'name')?>
        <?=$form->field($label,'designer_login')
            ->dropDownList(User::findUsersByGroup('designer'))?>
        <?=$form->field($label,'customer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Customer::find()->all(), 'id', 'name'),
            'pluginOptions' => [
                'allowClear' => false
            ],
        ])?>
        <?=$form->field($label,'pants_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Pants::find()->all(), 'id', 'name'),
            'pluginOptions' => [
                'allowClear' =>false
            ],
        ])?>

        <?=$form->field($label,'shaft_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Shaft::find()->all(), 'id', 'name'),
            'pluginOptions' => [
                'allowClear' =>false
            ],
        ])?>
        <?=$form->field($label,'foil_id')
            ->dropDownList(ArrayHelper::map(Foil::find()->all(), 'id', 'name'))?>
        <h6>Вид лака: <small><?=Html::encode($label->varnishStatusName)?></small> </h6>
        <h6>Ламинация: <small><?=Html::encode($label->laminateName)?></small> Трафарет: <small class="badge badge-secondary"><?=Html::encode($label->stencilName)?></small></h6>
        <h6>Перем.печать: <small class="badge badge-secondary"><?=Html::encode($label->variableName)?></small> Печать по клею: <small class="badge badge-secondary"><?=Html::encode($label->printOnGlueName)?></small> </h6>
        <h6 class="badge badge-primary"><?=Html::encode($label->fullCMYK)?></h6>
        <h6>Выход этикетки: <?=Html::img($label->outputLabel->image, ['alt' => $label->outputLabel->name,
                'width'=>'100px'])?></h6>
    </div>
</div>
<div class="row">
    <div class="media border col">
        <blockquote class="blockquote">
            <small><?=Html::encode($label->designer_note)?></small>
            <footer class="blockquote-footer">Примечание дизайнера</footer>
        </blockquote>
    </div>
    <div class="media border col">
        <blockquote class="blockquote">
            <small><?=Html::encode($label->manager_note)?></small>
            <footer class="blockquote-footer">Примечание менеджера</footer>
        </blockquote>
    </div>
    <div class="media border col">
        <blockquote class="blockquote">
            <small><?=Html::encode($label->prepress_note)?></small>
            <footer class="blockquote-footer">Примечание Prepress</footer>
        </blockquote>
    </div>
</div>
<?ActiveForm::end()?>