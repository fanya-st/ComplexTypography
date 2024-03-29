<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pants;
use app\models\Shaft;
use yii\helpers\Url;
use yii\web\View;
use app\models\Mashine;
use app\models\Material;
use kartik\select2\Select2;

$this->title = Html::encode('Калькулятор');
$this->params['breadcrumbs'][] = $this->title;
$url=Url::toRoute(['calculator/get-pants-param','pants_id'=>'']);
$csrfToken = Yii::$app->request->csrfToken;
$this->registerJs(
    "
    function getPantsParam() {
    var pants_id=document.getElementById('calculator-pants_id').value;
     $.ajax({
        url: '".$url."'+pants_id,
        date: {_csrf: '".$csrfToken."'},
        method: 'GET',
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
<h3><?php echo  Html::encode($this->title)?></h3>
<?php $form=ActiveForm::begin(['method'=>'post'])?>
<?php if($calculator->calculated_label_price):?>
    <div class="border p-3 rounded">
        <h6 class="bg-light p-1 rounded">Результаты расчета</h6>
        <div class="p-1 row">
            <div class="col">
                <?php echo Html::tag('h6','Общая стоимость материалов: ' .round($calculator->calculated_material_price, 3).' руб.')?>
                <?php echo Html::tag('h6','Стоимость работы: ' .round($calculator->calculated_job_price, 3).' руб.')?>
                <?php echo Html::tag('h6','Стоимость бумаги: ' .round($calculator->calculated_paper_price, 3).' руб.')?>
                <?php echo Html::tag('h6','Стоимость фольги: ' .round($calculator->calculated_foil_price, 3).' руб.')?>
                <?php echo Html::tag('h6','Стоимость гол.фольги: ' .round($calculator->calculated_foil_holo_price, 3).' руб.')?>
            </div>
            <div class="col">
                <?php echo Html::tag('h6','Стоимость форм: ' .round($calculator->calculated_form_price, 3).' руб.')?>
                <?php echo Html::tag('h6','Стоимость глянцевого лака: ' .round($calculator->calculated_matte_varnish_price, 3).' руб.')?>
                <?php echo Html::tag('h6','Стоимость матового лака: ' .round($calculator->calculated_glossy_varnish_price, 3).' руб.')?>
                <?php echo Html::tag('h6','Стоимость красок: ' .round($calculator->calculated_paint_price, 3).' руб.')?>
                <?php echo Html::tag('h6','Стоимость красок для переменной печати: ' .round($calculator->calculated_variable_paint_price, 3).' руб.')?>
            </div>
            <div class="col">
                <?php echo Html::tag('h6','Стоимость скотча: ' .round($calculator->calculated_scotch_price, 3).' руб.')?>
                <?php echo Html::tag('h6','Площадь бумаги общая: ' .round($calculator->calculated_square_paper_common, 3).' м2.')?>
                <?php echo Html::tag('h6','Длина бумаги общая: ' .round($calculator->calculated_paper_length_common, 3).' м.')?>
                <?php echo Html::tag('h6','Общее время: ' .round($calculator->calculated_time_common, 3).' ч')?>
                <?php echo Html::tag('h6','Время на настройку: ' .round($calculator->calculated_time_adjust, 3).' ч')?>
                <?php echo Html::tag('h6','Время печати: ' .round($calculator->calculated_time_print, 3).' ч')?>
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
                <th><?php echo round($calculator->calculated_label_price, 3)?></th>
                <th><?php echo round($calculator->calculated_label_price_tax, 3)?></th>
                <th><?php echo round($calculator->calculated_circulation_price, 3)?></th>
                <th><?php echo round($calculator->calculated_circulation_price_tax, 3)?></th>
                <th><?php echo $calculator->circulation?></th>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
<?php endif;?>
<div class="row g-2 row-cols-lg-2">
    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="bg-success p-1 rounded">Параметры штанца</h6>
            <div class="row">
                <div class="col">
                    <?php echo  $form->field($calculator, 'pants_id')
                        ->widget(Select2::class, [
                        'data' => ArrayHelper::map(Pants::find()->asArray()->all(), 'id', 'id'),
                        'options' => ['placeholder' => 'Выбрать штанец ...'],
                    ]) ?>

                    <?php echo  Html::button('Получить параметры штанца', ['class' => 'btn btn-success m-2','onclick'=>'getPantsParam()']) ?>

                    <?php echo  $form->field($pants, 'width_label')->textInput() ?>

                    <?php echo  $form->field($pants, 'paper_width')->textInput() ?>

                </div>
                <div class="col">
                    <?php echo  $form->field($pants, 'shaft_id')->dropDownList(ArrayHelper::map(Shaft::find()->asArray()->all(),'id','name')) ?>

                    <?php echo  $form->field($pants, 'height_label')->textInput() ?>

                    <?php echo  $form->field($pants, 'cuts')->textInput() ?>

                </div>
            </div>
            <?php echo  Html::submitButton('Расчитать', ['class' => 'btn btn-success m-2']) ?>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="bg-primary p-1 rounded">Параметры бумаги и расходных материалов</h6>
            <div class="row">
                <div class="col">
                    <?php echo  $form->field($calculator, 'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->where(['mashine_type'=>0])->asArray()->all(),'id','name')) ?>

                    <?php echo  $form->field($calculator, 'material_id')->dropDownList(ArrayHelper::map(Material::find()->joinWith('materialGroup')->asArray()->all(),
                        'id', 'name','materialGroup.name')) ?>

                    <?php echo  $form->field($calculator, 'circulation')->textInput() ?>

                    <?php echo  $form->field($calculator, 'other_cost')->textInput() ?>
                </div>
                <div class="col">

                    <?php echo  $form->field($calculator, 'variable_mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->where(['mashine_type'=>2])->asArray()->all(),'id','name')) ?>

                    <?php echo  $form->field($calculator, 'price_increase')->checkbox() ?>

                    <?php echo  $form->field($calculator, 'layout')->checkbox() ?>

                    <?php echo  $form->field($calculator, 'form_price')->checkbox() ?>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="bg-info p-1 rounded">Параметры красок</h6>
            <div class="row">
                <div class="col">
                    <?php echo  $form->field($calculator, 'cmyk_count')->textInput() ?>

                    <?php echo  $form->field($calculator, 'pantone_count')->textInput() ?>

                    <?php echo  $form->field($calculator, 'mixed_pantone_count')->textInput() ?>

                    <?php echo  $form->field($calculator, 'variable_paint_count')->textInput() ?>
                </div>
                <div class="col">
                    <?php echo  $form->field($calculator, 'variable')->checkbox() ?>

                    <?php echo  $form->field($calculator, 'original_paint_selection')->checkbox() ?>

                    <?php echo  $form->field($calculator, 'combinated_label')->textInput() ?>

                    <?php echo  $form->field($calculator, 'exchangeable_form_count')->textInput() ?>


                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="border p-3 rounded">
            <h6 class="bg-danger p-1 rounded">Параметры отделки</h6>
            <div class="row">
                <div class="col">
                    <?php echo  $form->field($calculator, 'stencil_mesh_filling')->textInput() ?>

                    <?php echo  $form->field($calculator, 'foil_width')->textInput() ?>

                    <?php echo  $form->field($calculator, 'holo_foil_width')->textInput() ?>

                    <?php echo  $form->field($calculator, 'laminate_width')->textInput() ?>
                </div>
                <div class="col">
                    <?php echo  $form->field($calculator, 'matte_varnish')->checkbox() ?>

                    <?php echo  $form->field($calculator, 'glossy_varnish')->checkbox() ?>

                    <?php echo  $form->field($calculator, 'print_on_glue')->checkbox() ?>

                    <?php echo  $form->field($calculator, 'book')->checkbox() ?>

                    <?php echo  $form->field($calculator, 'stamping')->checkbox() ?>

                    <?php echo  $form->field($calculator, 'stencil')->checkbox() ?>

                    <?php echo  $form->field($calculator, 'stencil_mesh')->checkbox() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end()?>

<!--<pre>--><?php //print_r($calculator)?><!--</pre>-->
<!--<pre>--><?php //print_r($pants)?><!--</pre>-->
<!--<pre>--><?php //print_r(CalcMashineParamValue::getMashineParam(1))?><!--</pre>-->
<!--<pre>--><?php //print_r(CalcMashineParamValue::find()->joinWith('calcMashineParam')->where(['mashine_id'=>1])->all())?><!--</pre>-->
<!--<pre>--><?php //print_r(CalcCommonParam::getCommonParam())?><!--</pre>-->
<!--<pre>--><?php //print_r(Material::find()->select('price_euro')->where(['material_group_id'=>6])->orderBy(['price_euro'=>SORT_DESC])->one()->price_euro)?><!--</pre>-->
