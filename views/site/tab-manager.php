<?php
use yii\bootstrap5\Html;
?>
<div class="row g-2 row-cols-lg-2 text-nowrap">

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Заказы</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Заказы', ['order/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Отгрузки', ['shipment/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Излишки', ['finished-products-warehouse/surplus-list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Создать заказ', ['order/create'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Создать заказ c готовой этикеткой', ['order/create-blank'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Этикетки</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Этикетки', ['label/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Создание этикетки', ['label/create'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Калькулятор', ['calculator/calculator'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Заказчики', ['customer/list'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Материалы</h6>
            <div class="d-lg-flex flex-wrap ">
                <div class="p-1"><?= Html::a('Штанцы', ['pants/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Краски, лаки и химия', ['pantone/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Склад красок, лаков и химии', ['pantone-warehouse/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Бумага, фольга, ламинация', ['material/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Склад бумаги, фольги, ламинации', ['paper-warehouse/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Наличные складские запасы бумаги', ['material/stock-on-hand-paper'], ['class' => 'btn btn-primary']) ?></div>
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
                <div class="p-1"><?= Html::a('Электронный табель', ['/'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>


    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Календарь событий</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Календарь', ['/'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Командировки сотрудников', ['business-trip-employee/index'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

</div>
