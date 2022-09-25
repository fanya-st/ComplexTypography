<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use kartik\label\LabelInPlace;
use app\models\PantoneKind;
use yii\helpers\ArrayHelper;
?>
<?php $form = ActiveForm::begin(['action' => ['pantone/index'], 'method' => 'post'])?>

<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1"><?php echo $form->field($model,'id')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?php echo $form->field($model,'name')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?php echo $form->field($model,'pantone_kind_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(PantoneKind::find()->asArray()->all(),'id','name'),
                    'options' => ['placeholder' => 'Выбрать тип'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
        </div>
        <div class="p-1"><?php echo  Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>

<?php ActiveForm::end() ?>
