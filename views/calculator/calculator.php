<?php

use app\models\CalcCommonParam;
use app\models\CalcMashineParamValue;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pants;
use yii\widgets\Pjax;
use app\models\Shaft;
use yii\web\View;
use app\models\Mashine;
use app\models\Material;

$this->title = Html::encode('Калькулятор');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(
    "
    function getPantsParam() {
    var pants_id=document.getElementById('calculator-pants_id').value;
     $.ajax({
        url: 'index.php?r=calculator/get-pants-param&pants_id='+pants_id,
        date: { pants_id:pants_id,_csrf:'".Yii::$app->request->csrfToken."'},
        method: 'POST',
        dataType: 'json',
        success: function (date) {
            document.getElementById('pants-width_label').value=date.message.width_label;
            document.getElementById('pants-height_label').value=date.message.width_label;
            document.getElementById('pants-paper_width').value=date.message.paper_width;
            document.getElementById('pants-cuts').value=date.message.cuts;
            document.getElementById('pants-shaft_id').value=date.message.shaft_id;
            console.log(date);
        },
        error: function (date) {
            console.log(date);
        }
    })
     }
    ",
    View::POS_HEAD,
    'getPantsParam'
);
?>
<h3><?= Html::encode($this->title)?></h3>
<?//print_r(\app\models\)?>
<?$form=ActiveForm::begin(['method'=>'post'])?>
<?if($calculator->calculated_label_price):?>
    <div class="border p-3 rounded">
        <h6 class="bg-light p-1 rounded">Результаты расчета</h6>
        <div class="p-1 row">
            <div class="col">
                <?=Html::tag('h6','Общая стоимость материалов: ' .round($calculator->calculated_material_price, 3).' руб.')?>
                <?=Html::tag('h6','Стоимость работы: ' .round($calculator->calculated_job_price, 3).' руб.')?>
                <?=Html::tag('h6','Стоимость бумаги: ' .round($calculator->calculated_paper_price, 3).' руб.')?>
                <?=Html::tag('h6','Стоимость фольги: ' .round($calculator->calculated_foil_price, 3).' руб.')?>
                <?=Html::tag('h6','Стоимость гол.фольги: ' .round($calculator->calculated_foil_holo_price, 3).' руб.')?>
            </div>
            <div class="col">
                <?=Html::tag('h6','Стоимость форм: ' .round($calculator->calculated_form_price, 3).' руб.')?>
                <?=Html::tag('h6','Стоимость глянцевого лака: ' .round($calculator->calculated_matte_varnish_price, 3).' руб.')?>
                <?=Html::tag('h6','Стоимость матового лака: ' .round($calculator->calculated_glossy_varnish_price, 3).' руб.')?>
                <?=Html::tag('h6','Стоимость красок: ' .round($calculator->calculated_paint_price, 3).' руб.')?>
                <?=Html::tag('h6','Стоимость красок для переменной печати: ' .round($calculator->calculated_variable_paint_price, 3).' руб.')?>
            </div>
            <div class="col">
                <?=Html::tag('h6','Стоимость скотча: ' .round($calculator->calculated_scotch_price, 3).' руб.')?>
                <?=Html::tag('h6','Площадь бумаги общая: ' .round($calculator->calculated_square_paper_common, 3).' м2.')?>
                <?=Html::tag('h6','Длина бумаги общая: ' .round($calculator->calculated_paper_length_common, 3).' м.')?>
                <?=Html::tag('h6','Общее время: ' .round($calculator->calculated_time_common, 3).' ч')?>
                <?=Html::tag('h6','Время на настройку: ' .round($calculator->calculated_time_adjust, 3).' ч')?>
                <?=Html::tag('h6','Время печати: ' .round($calculator->calculated_time_print, 3).' ч')?>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Цена этикетки, руб</th>
                <th scope="col">Цена этикетки НДС, руб</th>
                <th scope="col">Цена тиража, руб</th>
                <th scope="col">Цена тиража НДС, руб</th>
                <th scope="col">Тираж, шт</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th><?=round($calculator->calculated_label_price, 3)?></th>
                <th><?=round($calculator->calculated_label_price_tax, 3)?></th>
                <th><?=round($calculator->calculated_circulation_price, 3)?></th>
                <th><?=round($calculator->calculated_circulation_price_tax, 3)?></th>
                <th><?=$calculator->circulation?></th>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
<?endif;?>
<div class="row g-2 row-cols-lg-2">
    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="bg-success p-1 rounded">Параметры штанца</h6>
            <div class="row">
                <div class="col">
                    <?= $form->field($calculator, 'pants_id')->dropDownList(ArrayHelper::map(Pants::find()->asArray()->all(),'id','name')) ?>

                    <?= Html::button('Получить параметры штанца', ['class' => 'btn btn-success m-2','onclick'=>'getPantsParam()']) ?>

                    <?= $form->field($pants, 'width_label')->textInput() ?>

                    <?= $form->field($pants, 'paper_width')->textInput() ?>

                </div>
                <div class="col">
                    <?= $form->field($pants, 'shaft_id')->dropDownList(ArrayHelper::map(Shaft::find()->asArray()->all(),'id','name')) ?>

                    <?= $form->field($pants, 'height_label')->textInput() ?>

                    <?= $form->field($pants, 'cuts')->textInput() ?>

                </div>
            </div>
            <?= Html::submitButton('Расчитать', ['class' => 'btn btn-success m-2']) ?>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="bg-primary p-1 rounded">Параметры бумаги и расходных материалов</h6>
            <div class="row">
                <div class="col">
                    <?= $form->field($calculator, 'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->where(['mashine_type'=>0])->asArray()->all(),'id','name')) ?>

                    <?= $form->field($calculator, 'material_id')->dropDownList(ArrayHelper::map(Material::find()->joinWith('materialGroup')->asArray()->all(),
                        'id', 'name','materialGroup.name')) ?>

                    <?= $form->field($calculator, 'circulation')->textInput() ?>

                    <?= $form->field($calculator, 'other_cost')->textInput() ?>
                </div>
                <div class="col">

                    <?= $form->field($calculator, 'variable_mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->where(['mashine_type'=>2])->asArray()->all(),'id','name')) ?>

                    <?= $form->field($calculator, 'price_increase')->checkbox() ?>

                    <?= $form->field($calculator, 'layout')->checkbox() ?>

                    <?= $form->field($calculator, 'form_price')->checkbox() ?>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="bg-info p-1 rounded">Параметры красок</h6>
            <div class="row">
                <div class="col">
                    <?= $form->field($calculator, 'cmyk_count')->textInput() ?>

                    <?= $form->field($calculator, 'pantone_count')->textInput() ?>

                    <?= $form->field($calculator, 'mixed_pantone_count')->textInput() ?>

                    <?= $form->field($calculator, 'variable_paint_count')->textInput() ?>
                </div>
                <div class="col">
                    <?= $form->field($calculator, 'variable')->checkbox() ?>

                    <?= $form->field($calculator, 'original_paint_selection')->checkbox() ?>

                    <?= $form->field($calculator, 'combinated_label')->textInput() ?>

                    <?= $form->field($calculator, 'exchangeable_form_count')->textInput() ?>


                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="border p-3 rounded">
            <h6 class="bg-danger p-1 rounded">Параметры отделки</h6>
            <div class="row">
                <div class="col">
                    <?= $form->field($calculator, 'stencil_mesh_filling')->textInput() ?>

                    <?= $form->field($calculator, 'foil_width')->textInput() ?>

                    <?= $form->field($calculator, 'holo_foil_width')->textInput() ?>

                    <?= $form->field($calculator, 'laminate_width')->textInput() ?>
                </div>
                <div class="col">
                    <?= $form->field($calculator, 'matte_varnish')->checkbox() ?>

                    <?= $form->field($calculator, 'glossy_varnish')->checkbox() ?>

                    <?= $form->field($calculator, 'print_on_glue')->checkbox() ?>

                    <?= $form->field($calculator, 'book')->checkbox() ?>

                    <?= $form->field($calculator, 'stamping')->checkbox() ?>

                    <?= $form->field($calculator, 'stencil')->checkbox() ?>

                    <?= $form->field($calculator, 'stencil_mesh')->checkbox() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?ACtiveForm::end()?>

<pre><?print_r($calculator)?></pre>
<!--<pre>--><?//print_r($pants)?><!--</pre>-->
<!--<pre>--><?//print_r(CalcMashineParamValue::getMashineParam(1))?><!--</pre>-->
<!--<pre>--><?//print_r(CalcMashineParamValue::find()->joinWith('calcMashineParam')->where(['mashine_id'=>1])->all())?><!--</pre>-->
<!--<pre>--><?//print_r(CalcCommonParam::getCommonParam())?><!--</pre>-->
<!--<pre>--><?//print_r(Material::find()->select('price_euro')->where(['material_group_id'=>6])->orderBy(['price_euro'=>SORT_DESC])->one()->price_euro)?><!--</pre>-->
