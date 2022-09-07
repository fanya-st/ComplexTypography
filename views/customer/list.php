<?php


use yii\bootstrap5\Html;
//use kartik\grid\GridView;
use yii\grid\GridView;
use app\models\User;

$this->title = 'Работа с заказчиками';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?echo $this->render('_search', ['model' => $searchModel])?>
<div class="d-lg-flex flex-wrap">
    <div class="p-2"><?= Html::a('Добавить заказчика', ['/customer/create'], ['class'=>'btn btn-primary']) ?></div>
</div>
<? echo GridView::widget([
    'dataProvider' => $customers,
    'id'=>'order-list',
    'columns' => [
        'id',
        'name',
        'customerAddress',
        [
                'attribute'=>'user_id',
                'value'=>function($model){
                        return User::getFullNameById($model->user_id);
                },
        ],
        'email',
        'number',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}'
        ],
    ],
]);
?>
