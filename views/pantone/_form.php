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
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price_rub')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price_euro')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'pantone_kind_id')->dropDownList(ArrayHelper::map(PantoneKind::find()->asArray()->all(),'id','name')) ?>

            <?= $form->field($model, 'price_rub_discount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price_euro_discount')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col">
            <?=$form->field($model, 'mashine_list')->checkboxList(ArrayHelper::map(Mashine::find()->all(),'id','name'));?>
        </div>

    </div>

    <?= $form->field($model, 'subscribe')->textarea([]) ?>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success','name'=>'update_pantone_param']) ?>
    <?ActiveForm::end()?>

    <?php $form = ActiveForm::begin([]) ?>
    <?if(!empty($mixed_pantones)):?>
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
                <?foreach ($mixed_pantones as $id => $mixed_pantone):?>
                    <tr>
                        <td>
                            <?
                            echo $form->field($mixed_pantone,"[$id]component_pantone_id")
                                ->dropDownList(ArrayHelper::map(Pantone::find()->asArray()->all(),'id','name'), [
                                    'prompt' => 'Выберите...'
                                ])->label(false);

                            ?>
                        </td>
                        <td>
                            <?
                            echo $form->field($mixed_pantone,"[$id]weight")->label(false);
                            ?>
                        </td>
                    </tr>
                <?endforeach;?>
                </tbody>
            </table>
        </div>
        <?= Html::submitButton('Сохранить состав', ['class' => 'btn btn-success','name'=>'update_mixed_param']) ?>
    <?endif;?>
    <?ActiveForm::end()?>

</div>



