<?php
use yii\bootstrap5\Html;
use app\models\Order;
use app\models\User;
use yii\widgets\Pjax;
?>
<div class="row g-2 row-cols-lg-2 text-nowrap">

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Очередь этикеток</h6>
            <div class="p-1">
                <?php Pjax::begin(); ?>
                <ol class="list-group list-group-numbered">
                    <?php foreach(Order::find()->andFilterWhere(['order.status_id'=>1])->joinWith('label')->andFilterWhere(['label.status_id'=>[4,5]])->orderBy(['date_of_sale'=>SORT_ASC])->limit(3)->all() as $order):?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"><span class="badge bg-primary rounded-pill">№<?php echo $order->id?></span> <?php echo $order->label->name?></div>
                                <?php echo $order->label->customer->name?> (<?php echo User::getFullNameById($order->label->customer->user_id)?>)
                            </div>
                            <?php echo  Html::a('Начать препресс', ['label/view', 'id' => $order->label_id], ['class' => 'btn btn-primary']) ?>
                        </li>
                    <?php endforeach;?>
                </ol>
                <!--            --><?php //= Html::a("Обновить", ['site/index'], ['class' => 'btn btn-lg btn-primary','id' => 'refreshButton']) ?>
                <?php Pjax::end(); ?>
            </div>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?php echo  Html::a('Заказы', ['order/list'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?php echo  Html::a('Этикетки', ['label/list'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Материалы</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?php echo  Html::a('Краски, лаки и химия', ['pantone/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?php echo  Html::a('Штанцы', ['pants/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?php echo  Html::a('Валы', ['shaft/index'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?php echo  Html::a('Добавить штанец', ['pants/create'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Бухгалтерия</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?php echo  Html::a('Затраты предприятия', ['enterprise-cost/index'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Статистика</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?php echo  Html::a('Отчет по Prepress', ['/'], ['class' => 'btn btn-primary']) ?></div>
                <div class="p-1"><?php echo  Html::a('Электронный табель', ['time-tracker/index'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>
</div>
