<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;

$this->title = 'Работа с заказчиками';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?echo $this->render('_search', ['model' => $searchModel])?>
<? echo GridView::widget([
    'dataProvider' => $customers,
    'id'=>'order-list',
    'columns' => [
        'id',
        'name',
        'customerAddress',
        'managerFullName',
        'email',
        'number',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{view},{update}'
        ],
    ],
]);
?>
