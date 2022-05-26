<?php


use yii\bootstrap4\Html;
use yii\grid\GridView;

$this->title = 'Работа с заказами';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-list">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><a class="btn btn-outline-secondary" href="?r=order%2Fcreate">Создание заказа &raquo;</a></p>
</div>
    <?
    echo GridView::widget([
        'dataProvider' => $orders,

        'columns' => [
            'id',
            'name',
            'label.name',
            'date_of_create',
            'label.name',
            'fullName',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}'
                ],
        ],
    ]);
    ?>
