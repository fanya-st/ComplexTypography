<?php
$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h4>Заказы</h4>
                <p><a class="btn btn-outline-secondary" href="?r=order/list">Заказы &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=order/create-blank">Создание заказа с готовой этикеткой &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=order/create">Создание заказа &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=shipment/list">Отгрузки &raquo;</a><a class="m-1 btn btn-outline-secondary" href="?r=finished-products-warehouse/surplus-list">Излишки &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h4>Материалы</h4>
                <p><a class="btn btn-outline-secondary" href="?r=material/list">Материалы &raquo;</a><a class="m-1 btn btn-outline-secondary" href="?r=pantone/index">Краски, лаки, химия &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=paper-warehouse/list">Склад бумаги, фольги, ламинации &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=pantone-warehouse/index">Склад красок, лаков и химии &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=paper-warehouse/roll-cut">Разрезать ролик &raquo;</a><a class="m-1 btn btn-outline-secondary" href="?r=pants/index">Штанцы &raquo;</a><a class=" btn btn-outline-secondary" href="?r=shaft/index">Валы &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h4>Этикетки</h4>
                <p><a class="btn btn-outline-secondary" href="?r=label/list">Этикетки &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=label%2Fcreate">Создание этикетки &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=calculator/calculator">Калькулятор &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=envelope/index">Конверты &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h4>Заказчики</h4>
                <p><a class="btn btn-outline-secondary" href="?r=customer/list">Заказчики &raquo;</a><a class="m-1 btn btn-outline-secondary" href="?r=customer/create">Добавить заказчика &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=transport/index">Транспорт &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h4>Сотрудники</h4>
                <p><a class="btn btn-outline-secondary" href="?r=employee/list">Сотрудники &raquo;</a><a class="m-1 btn btn-outline-secondary" href="?r=time-tracker/kiosk">Учет рабочего времени &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=business-trip-employee/index">Командировки сотрудников &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h4>Бухгалтерия</h4>
                <p><a class="btn btn-outline-secondary" href="?r=enterprise-cost/index">Затраты предприятия &raquo;</a><a class="m-1 btn btn-outline-secondary" href="?r=bank-transfer/index">Банк &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=material/material-movement">Оборотная ведомость по материалу &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=material/stock-on-hand-paper">Наличные складские запасы бумаги &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=financial-report/index">Финансовый отчет &raquo;</a></p>
            </div>
        </div>
    </div>
</div>
