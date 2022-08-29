<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Customer;
use app\models\Mashine;
use app\models\Pants;
use app\models\Label;
use kartik\select2\Select2;
use kartik\datetime\DateTimePicker;
use app\models\PantonePriceArchive;

$this->title = Html::encode('Финансовый отчет');
$this->params['breadcrumbs'][] = $this->title;

?>
<h3><?= Html::encode($this->title)?></h3>

<?$form=ActiveForm::begin()?>
<?=$form->field($searchModel,'date_of_print_start')->widget(DateTimePicker::class, [
    'options' => ['placeholder' => 'Введите начало периода ...'],
    'pluginOptions' => [
        'todayBtn' => true,
        'autoclose' => true
    ]
])?>

<?=$form->field($searchModel,'date_of_print_end')->widget(DateTimePicker::class, [
    'options' => ['placeholder' => 'Введите конец периода ...'],
    'pluginOptions' => [
        'todayBtn' => true,
        'autoclose' => true
    ]
])?>

<?=$form->field($searchModel,'label_id')->widget(Select2::class, [
    'data' => ArrayHelper::map(Label::find()->all(), 'id', 'nameSplitId'),
    'options'=>[
        'placeholder' => ' Выберите этикетку ...',
    ],
    'pluginOptions' => [
        'allowClear' => true
    ],
])?>

<?=$form->field($searchModel,'mashine_id')->dropDownList(ArrayHelper::map(Mashine::find()->asArray()->all(),'id','name'),['prompt'=>''])?>

<?=$form->field($searchModel,'customer_id')->widget(Select2::class, [
    'data' => ArrayHelper::map(Customer::find()->asArray()->all(), 'id', 'name'),
    'options'=>[
        'placeholder' => ' Выберите заказчика ...',
    ],
    'pluginOptions' => [
        'allowClear' => true
    ],
])?>


<?=$form->field($searchModel,'pants_id')->widget(Select2::class, [
    'data' => ArrayHelper::map(Pants::find()->asArray()->all(), 'id', 'id'),
    'options'=>[
        'placeholder' => ' Выберите штанец ...',
    ],
    'pluginOptions' => [
        'allowClear' => true
    ],
])?>
<?=$form->field($searchModel,'excel')->checkbox()?>

<div class="d-lg-inline-flex">
    <div class="p-2"><?=html::submitButton('Показать',['name'=>'show','class'=>'btn btn-success'])?></div>
</div>

<?ActiveForm::end()?>
<?//print_r(PantonePriceArchive::getPriceAverage('2022-06-20 10:08:06',[4,5],null,0))?>
<?if(!empty($orders)):?>
    <div class="p-1 table-responsive-sm">
        <table class="table table-sm small text-center text-wrap table-bordered table-striped caption-top">
            <caption>Финансовый отчет <?=$searchModel->date_of_print_start.' - '.$searchModel->date_of_print_end?></caption>
            <thead>
            <tr class="table-info">
                <th scope="col">Заказ</th>
                <th scope="col">Кол-во материалов</th>
                <th scope="col">Себестоимость</th>
                <th scope="col">Результат</th>
            </tr>
            </thead>
            <tbody>
            <?foreach($orders as $order):?>
                <tr>
                    <td>
                        <ul class="list-group">
                            <li class="list-group-item">Станок: <?=Mashine::findOne($order->mashine_id)->name?></li>
                            <li class="list-group-item">Дата конца печати: <?=$order->date_of_print_end ?></li>
                            <li class="list-group-item">Заказчик: <?=$order->label->customer->name?> Менеджер: <?=User::getFullNameByUsername($order->label->customer->manager_login)?></li>
                            <li class="list-group-item">Заказ №: <div class="badge bg-primary"><?=$order->id?></div> Этикетка №: <div class="badge bg-primary"><?=$order->label->id?></div></li>
                            <li class="list-group-item">Штанец №: <?=$order->label->pants_id?> Вал, мм: <?=$order->label->pants->shaft->name?></li>
                            <li class="list-group-item">Размер этикетки (ШхВ), мм : <?=$order->label->pants->width_label.'x'.$order->label->pants->height_label?></li>
                            <li class="list-group-item">Наименование: <?=$order->label->name?></li>
                            <li class="list-group-item">План.тираж: <?=$order->plan_circulation?> Отправка: <?=$order->sending?></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="list-group">
                            <li class="list-group-item">Чистый тираж, м<sup>2</sup>: <?=round($order->square_clear_circulation,2)?></li>
                            <li class="list-group-item">Чистый тираж, м: <?=round($order->length_clear_circulation,2)?></li>
                            <li class="list-group-item">Бумага, м: <?=round($order->length_order,2)?></li>
                            <li class="list-group-item">Бумага, м<sup>2</sup>: <?=round($order->square_order,2)?></li>
                            <li class="list-group-item">Фольга, м<sup>2</sup>: <?=round($order->square_foil,2)?></li>
                            <li class="list-group-item">Ламинация, м<sup>2</sup>: <?=round($order->square_laminate,2)?></li>
                            <li class="list-group-item">Краска, кг: <?=round($order->paint_weight,2)?></li>
                            <li class="list-group-item">Лак, кг: <?=round($order->varnish_weight,2)?></li>
                            <li class="list-group-item">Время печати, ч: <?=round($order->print_time,2)?></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="list-group">
                            <li class="list-group-item">Бумага, руб: <?=round($order->paper_price,2)?></li>
                            <li class="list-group-item">Фольга, руб: <?=round($order->foil_price,2)?></li>
                            <li class="list-group-item">Формы, руб: <?=round($order->form_price,2)?></li>
                            <li class="list-group-item">Ламинация, руб: <?=round($order->laminate_price,2)?></li>
                            <li class="list-group-item">Трафарет, руб: <?=round($order->stencil_price,2)?></li>
                            <li class="list-group-item">Скотч, руб: <?=round($order->scotch_price,2)?></li>
                            <li class="list-group-item">Краска, руб: <?=round($order->paint_price,2)?></li>
                            <li class="list-group-item">Лак, руб: <?=round($order->varnish_price,2)?></li>
                            <li class="list-group-item">Др.затраты, руб: <?=round($order->enterprise_cost,2)?></li>
                            <li class="list-group-item">Доставка, руб: <?=round($order->transport_price,2)?></li>
                        </ul>
                    </td>
                    <td>
                        <ul class="list-group">
                            <li class="list-group-item">Длительность заказа, ч: <?=round($order->order_time,2)?></li>
                            <li class="list-group-item">Факт. тираж: <?=$order->actual_circulation?></li>
                            <li class="list-group-item">Факт. отправлено: <?=$order->circulationCountSend?></li>
                            <li class="list-group-item">Себестомость тиража, руб: <?=round($order->circulation_price,3)?></li>
                            <li class="list-group-item">Себестомость этикетки, руб: <?=round($order->one_label_material_price,3)?></li>
                            <li class="list-group-item">Цена этикетки НДС, руб: <?=round($order->label_price_with_tax,3)?></li>
                            <li class="list-group-item">Цена тиража по отгрузке НДС, руб: <?=round($order->order_send_price,3)?></li>
                            <li class="list-group-item">Коэфф. эффективности: <span class="badge bg-primary"><?=round($order->efficiency_ratio,3)?></span></li>
                            <li class="list-group-item <?if($order->order_income>=0) echo 'bg-success'; else echo 'bg-danger';?>">Доход, руб: <?=round($order->order_income,3)?></li>
                        </ul>
                    </td>
                </tr>
                <tr class="table-warning">
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
            <?endforeach;?>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
<?endif ;?>
<pre><?print_r($orders)?></pre>
