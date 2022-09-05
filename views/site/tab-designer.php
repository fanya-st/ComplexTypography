<?php
use yii\bootstrap5\Html;
?>

<div class="row g-2 row-cols-lg-2 text-nowrap">

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Этикетки</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Этикетки', ['label/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Заказчики', ['customer/list'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Материалы</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Штанцы', ['pants/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Валы', ['shaft/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Краски, лаки и химия', ['pantone/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Бумага, фольга, ламинация', ['material/list'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Статистика</h6>
            <div class="d-lg-flex flex-wrap">
                    <div class="p-1"><?= Html::a('Финансовый отчет', ['financial-report/index'], ['class' => 'btn btn-primary']) ?></div>
                    <div class="p-1"><?= Html::a('Электронный табель', ['/'], ['class' => 'btn btn-primary']) ?></div>
                    <div class="p-1"><?= Html::a('Отчет по дизайнерам', ['/'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>


</div>