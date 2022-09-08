<?php
use yii\bootstrap5\Html;
?>
<div class="row g-2 row-cols-lg-2">

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Заказы</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Заказы', ['order/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Отгрузки', ['shipment/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Заказчики', ['customer/list'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Статистика и Бухгалтерия</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Затраты предприятия', ['enterprise-cost/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Банк', ['bank-transfer/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Финансовый отчет', ['financial-report/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Показатели работы предприятия', ['/'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Электронный табель', ['time-tracker/index'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Материалы</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Наличные складские запасы бумаги', ['material/stock-on-hand-paper'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Оборотная ведомость по материалу', ['material/material-movement'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

</div>
