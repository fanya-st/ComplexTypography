<?php
use yii\bootstrap5\Html;
use app\models\Order;
use app\models\User;
use yii\widgets\Pjax;
?>
<div class="row g-2 row-cols-lg-2 text-nowrap">

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Очередь перемотки</h6>
            <div class="p-1">
                    <?php Pjax::begin(); ?>
                    <ol class="list-group list-group-numbered">
                        <?foreach(Order::find()->andFilterWhere(['status_id'=>5])->orderBy(['date_of_sale'=>SORT_ASC])->limit(3)->all() as $order):?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold"><span class="badge bg-primary rounded-pill">№<?=$order->id?></span> <?=$order->label->name?></div>
                                    <?=$order->label->customer->name?> (<?=User::getFullNameByUsername($order->label->customer->manager_login)?>)
                                </div>
                                <?= Html::a('Начать перемотку', ['order/start-rewind', 'id' => $order->id], ['class' => 'btn btn-primary']) ?>
                            </li>
                        <?endforeach;?>
                    </ol>
                    <!--            --><?//= Html::a("Обновить", ['site/index'], ['class' => 'btn btn-lg btn-primary','id' => 'refreshButton']) ?>
                    <?php Pjax::end(); ?>
            </div>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Заказы', ['order/list'], ['class' => 'btn btn-primary']) ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg">
        <div class="border p-3 rounded">
            <h6 class="p-1 rounded">Статистика</h6>
            <div class="d-lg-flex flex-wrap">
                <div class="p-1"><?= Html::a('Отчет по перемотчикам', ['/'], ['class' => 'm-1 btn btn-primary']) ?></div>
                <div class="p-1"><?= Html::a('Электронный табель', ['/'], ['class' => 'm-1 btn btn-primary']) ?></div>
            </div>
        </div>
    </div>
</div>