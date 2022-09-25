<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use app\models\User;
use  kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use app\models\AuthItem;

?>
<?php $form = ActiveForm::begin(['action' => ['time-tracker/index'], 'method' => 'post'])?>

<div class="text-nowrap">
    <div class="border p-3 rounded">
        <div class="d-lg-flex flex-wrap">
            <div class="p-1 flex-fill"><?php echo $form->field($model,'employee_id')->widget(Select2::class, [
                    'data' => User::findUsersIdDropdown(),
                    'options' => ['placeholder' => 'Сотрудник'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-fill"><?php echo $form->field($model,'role')->widget(Select2::class, [
                    'data' => ArrayHelper::map(AuthItem::find()->where(['type'=>1])->asArray()->all(),'name','description'),
                    'options' => ['placeholder' => 'Группа'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false)?></div>
            <div class="p-1 flex-lg-fill"><?php echo $form->field($model,'date_of_action')->widget(DateRangePicker::class, [
                    'attribute' => 'date',
                    'presetDropdown'=>true,
                    'convertFormat'=>true,
                    'pluginOptions' => ['locale' => ['format' => 'Y-m-d'],'selectOnClose'=>false],
                    'options' => ['placeholder' => 'Период...']
                ])->label(false)?></div>
        </div>
        <div class="p-1"><?php echo  Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?></div>
    </div>
</div>

<?php ActiveForm::end() ?>
