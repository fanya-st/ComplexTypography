<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use kartik\label\LabelInPlace;
use yii\helpers\ArrayHelper;
use app\models\Material;
use app\models\MaterialGroup;

?>
<?php $form = ActiveForm::begin(['action' => ['paper-warehouse/list'], 'method' => 'post'])?>

<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1"><?php echo $form->field($model,'id')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1 flex-fill"><?php echo $form->field($model,'material_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Material::find()->joinWith('materialGroup')->asArray()->all(), 'id', 'name','materialGroup.name'),
                    'options' => ['placeholder' => 'Выбрать материал'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?php echo $form->field($model,'material_group_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(MaterialGroup::find()->asArray()->all(),'id','name'),
                    'options' => ['placeholder' => 'Выбрать тип'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1"><?php echo $form->field($model,'length')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])->label(false) ?>
            </div>
            <div class="p-1"><?php echo $form->field($model,'width_from')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])->label(false) ?>
            </div>
            <div class="p-1"><?php echo $form->field($model,'width_to')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])->label(false) ?>
            </div>
        </div>
        <div class="p-1"><?php echo  Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>

<?php ActiveForm::end() ?>
