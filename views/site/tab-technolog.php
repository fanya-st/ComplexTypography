<?php
use yii\bootstrap5\Html;
?>
<div class="row g-2 row-cols-lg-2 text-nowrap">

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Заказы и этикетки</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Заказы', ['order/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Этикетки', ['label/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Излишки', ['finished-products-warehouse/surplus-list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Конверты', ['envelope/index'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>


    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Материалы</h6>
            <div class="d-lg-flex flex-wrap ">
                <div class="p-1"><?= Html::a('Краски, лаки и химия', ['pantone/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Бумага, фольга, ламинация', ['material/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Наличные складские запасы бумаги', ['material/stock-on-hand-paper'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Оборотная ведомость по материалу', ['material/material-movement'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Статистика</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Финансовый отчет', ['financial-report/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Отчет по печатникам', ['/'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Отчет по перемотчикам', ['/'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Электронный табель', ['time-tracker/index'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

</div>
