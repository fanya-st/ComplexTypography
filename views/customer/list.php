<?php


use yii\bootstrap5\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;
use app\models\User;

$this->title = 'Работа с заказчиками';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?echo $this->render('_search', ['model' => $searchModel])?>
<? echo GridView::widget([
    'dataProvider' => $customers,
//    'filterModel' => $searchModel,
    'id'=>'order-list',
    'columns' => [
        'id',
        'name',
        'customerAddress',
        [
                'attribute'=>'manager_login',
                'value'=>function($model){
                        return User::getFullNameByUsername($model->manager_login);
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
