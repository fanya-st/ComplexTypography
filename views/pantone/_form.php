<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\PantoneKind;
use app\models\Pantone;
use app\models\Mashine;

?>

<div class="pantone-form p-2">
    <?php $form = ActiveForm::begin() ?>
    <div class="row">
        <div class="col">
            <?php echo  $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?php echo  $form->field($model, 'price_euro')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">
            <?php echo  $form->field($model, 'pantone_kind_id')->dropDownList(ArrayHelper::map(PantoneKind::find()->asArray()->all(),'id','name')) ?>

        </div>
        <div class="col">
            <?php echo $form->field($model, 'mashine_list')->checkboxList(ArrayHelper::map(Mashine::find()->all(),'id','name'));?>
        </div>

    </div>

    <?php echo  $form->field($model, 'subscribe')->textarea([]) ?>

    <?php echo  Html::submitButton('Сохранить', ['class' => 'btn btn-success','name'=>'update_pantone_param']) ?>
    <?php ActiveForm::end()?>

    <?php $form = ActiveForm::begin([]) ?>
    <?php if(!empty($mixed_pantones)):?>
        <div>
            <table class="table table-sm table-bordered rounded caption-top">
                <caption>Состав смешанного PANTONE</caption>
                <thead>
                <tr>
                    <th scope="col">Компонент PANTONE</th>
                    <th scope="col">Вес</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($mixed_pantones as $id => $mixed_pantone):?>
                    <tr>
                        <td>
                            <?php
                            echo $form->field($mixed_pantone,"[$id]component_pantone_id")
                                ->dropDownList(ArrayHelper::map(Pantone::find()->asArray()->all(),'id','name'), [
                                    'prompt' => 'Выберите...'
                                ])->label(false);

                            ?>
                        </td>
                        <td>
                            <?php
                            echo $form->field($mixed_pantone,"[$id]weight")->label(false);
                            ?>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php echo  Html::submitButton('Сохранить состав', ['class' => 'btn btn-success','name'=>'update_mixed_param']) ?>
    <?php endif;?>
    <?php ActiveForm::end()?>

</div>



