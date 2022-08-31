<?php

?>
<div class="site-index-printer">

    <div class="body-content">
<!--        <h1>--><?//= Yii::$app->authManager->getRole('printer')->description?><!--</h1>-->
        <div class="row">
            <div class="col-lg-4">
                <h5>Заказы</h5>
                <p><a class="btn btn-outline-secondary" href="?r=order/list">Заказы &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h5>Материалы</h5>
                <p><a class="btn btn-outline-secondary" href="?r=paper-warehouse/roll-cut">Разрезать ролик &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=pants/index">Штанцы &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=pantone-warehouse/index">Склад красок, лаков и химии &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=paper-warehouse/list">Склад бумаги, фольги, ламинации &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=material/stock-on-hand-paper">Наличные складские запасы бумаги &raquo;</a></p>
                <p><a class="btn btn-outline-secondary" href="?r=">График баллов по печатникам &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h5>Статистика</h5>
                <p><a class="btn btn-outline-secondary" href="?r=">График баллов по печатникам &raquo;</a></p>
            </div>
        </div>
    </div>
</div>
