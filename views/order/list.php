<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
use app\models\Order;

$this->title = 'Работа с заказами';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-list">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<!--<pre>--><?//print_r(Order::findOne(1)->shaft)?><!--</pre>-->
    <?
    echo $this->render('_search', ['model' => $searchModel]);
    echo GridView::widget([
        'dataProvider' => $orders,

        'columns' => [
            'id',
            'labelName',
            'date_of_create',
            'orderStatusName',
            'labelStatusName',
            'mashineName',
            'fullName',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
                ],
        ],
    ]);
    ?>
