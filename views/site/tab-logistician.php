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
                <div class="p-1"><?= Html::a('Излишки', ['finished-products-warehouse/surplus-list'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Транспорт</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Транспорт', ['transport/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Командировки сотрудников', ['business-trip-employee/index'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Заказчики</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Заказчики', ['customer/list'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Статистика и Бухгалтерия</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Затраты предприятия', ['enterprise-cost/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Электронный табель', ['/'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>


</div>
