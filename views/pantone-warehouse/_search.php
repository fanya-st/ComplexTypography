<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use kartik\label\LabelInPlace;
use yii\helpers\ArrayHelper;
use app\models\Pantone;

?>
<?php $form = ActiveForm::begin(['action' => ['pantone-warehouse/index'], 'method' => 'post'])?>

<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1"><?=$form->field($model,'id')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])?></div>
            <div class="p-1"><?=$form->field($model,'pantone_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Pantone::find()->asArray()->all(),'id','name'),
                    'options' => ['placeholder' => 'Выбрать краску'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1"><?=$form->field($model,'weight')->widget(LabelInPlace::class,[
                    'type' => LabelInPlace::TYPE_HTML5,
                    'options' => ['type' => 'text']
                ])->label(false) ?>
            </div>
        </div>
        <div class="p-1"><?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>

<?php ActiveForm::end() ?>
