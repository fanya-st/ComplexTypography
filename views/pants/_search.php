<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use kartik\label\LabelInPlace;
use yii\helpers\ArrayHelper;
use app\models\Shaft;
use app\models\PantsKind;

?>
<?php $form = ActiveForm::begin(['action' => ['pants/index'], 'method' => 'post'])?>

<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1"><?php echo $form->field($model,'id')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?php echo $form->field($model,'cuts')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?php echo $form->field($model,'width_label')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?php echo $form->field($model,'height_label')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?php echo $form->field($model,'knife_width')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?php echo $form->field($model,'paper_width')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1 flex-fill"><?php echo $form->field($model,'shaft_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Shaft::find()->asArray()->all(),'id','name'),
                    'options' => ['placeholder' => 'Вал'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?php echo $form->field($model,'pants_kind_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(PantsKind::find()->asArray()->all(),'id','name'),
                    'options' => ['placeholder' => 'Вид штанца'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
        </div>
        <div class="p-1"><?php echo  Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>

<?php ActiveForm::end() ?>
