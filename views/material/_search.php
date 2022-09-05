<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use kartik\label\LabelInPlace;
use app\models\MaterialProvider;
use app\models\MaterialGroup;
use yii\helpers\ArrayHelper;

?>
<?php $form = ActiveForm::begin(['action' => ['material/list'], 'method' => 'post',])?>

<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1"><?=$form->field($model,'id')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?=$form->field($model,'name')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1 flex-fill"><?=$form->field($model,'material_group_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(MaterialGroup::find()->asArray()->all(),'id','name'),
                    'options' => ['placeholder' => 'Выбрать тип'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?=$form->field($model,'material_provider_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(MaterialProvider::find()->asArray()->all(),'id','name'),
                    'options' => ['placeholder' => 'Выбрать поставщика'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
        </div>
        <div class="p-1"><?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>

<?php ActiveForm::end() ?>
