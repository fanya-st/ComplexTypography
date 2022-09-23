<?php
use yii\bootstrap5\Html;
use yii\grid\GridView;
use app\models\User;
use kartik\icons\Icon;

$this->title = 'Работа с заказчиками';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php echo $this->render('_search', ['model' => $searchModel])?>
<div class="table-responsive">
<?php echo GridView::widget([
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
            'template' => '{update} {view}',
            'buttons' => [
                'update' => function($url, $model, $key) {     // render your custom button
                    return Html::a(Html::button( Icon::show('edit', ['class'=>'fa-0.1x'], Icon::FA),
                        ['class' => 'btn btn-outline-primary']), ['customer/update', 'id' => $model->id]);
                },
                'view' => function($url, $model, $key) {     // render your custom button
                    return Html::a(Html::button( Icon::show('eye', ['class'=>'fa-0.1x'], Icon::FA),
                        ['class' => 'btn btn-outline-success']), ['customer/view', 'id' => $model->id]);
                }
            ]
        ],
    ],
]);
?>
</div>
