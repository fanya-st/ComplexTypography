<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Shaft;
use app\models\PantsKind;
use app\models\KnifeKind;
use app\models\MaterialGroup;

?>
<!--<pre>--><?//print_r($model)?><!--</pre>-->
<?php $form = ActiveForm::begin(); ?>
<div class="pants-form">
    <div class="row">
        <div class="col">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'shaft_id')->dropDownList(ArrayHelper::map(Shaft::find()->asArray()->all(),'id','name')) ?>

            <?= $form->field($model, 'paper_width')->textInput() ?>

            <?= $form->field($model, 'pants_kind_id')->dropDownList(ArrayHelper::map(PantsKind::find()->asArray()->all(),'id','name')) ?>

            <?= $form->field($model, 'width_label')->textInput() ?>

            <?= $form->field($model, 'height_label')->textInput() ?>

        </div>
        <div class="col">
            <?= $form->field($model, 'cuts')->textInput() ?>

            <?= $form->field($model, 'knife_kind_id')->dropDownList(ArrayHelper::map(KnifeKind::find()->asArray()->all(),'id','name')) ?>

            <?= $form->field($model, 'knife_width')->textInput() ?>

            <?= $form->field($picture_form, 'picture')->fileInput() ?>

            <?= $form->field($model, 'radius')->textInput() ?>

            <?= $form->field($model, 'gap')->textInput() ?>

            <?= $form->field($model, 'material_group_id')->dropDownList(ArrayHelper::map(MaterialGroup::find()->asArray()->all(),'id','name')) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
