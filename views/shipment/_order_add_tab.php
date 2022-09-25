<?php
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\models\User;
use app\models\Customer;
use yii\helpers\ArrayHelper;

$this->title = 'Добавление заказов';
$this->params['breadcrumbs'][] = ['label' => 'Работа с отгрузками', 'url' => ['shipment/list']];
$this->params['breadcrumbs'][] = ['label' => 'Отгрузка ID['.$shipment->id.'] ', 'url' => ['shipment/view','id'=>$shipment->id]];
?>
    <h1><?php echo  Html::encode($this->title) ?></h1>
<?php
$form=ActiveForm::begin(['method'=>'post']);
echo Html::submitButton('Добавить',['class'=>'btn btn-primary']);
?>
<div class="table-responsive">
<?php echo  GridView::widget([
    'dataProvider' => $add_order,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'yii\grid\CheckboxColumn',
        ],
        [
            'attribute'=>'id',
            'label'=>'ID'
        ],
        [
            'attribute' => 'manager_id',
            'value' => function($model){
                return User::getFullNameById($model->customer->user_id);
                },
            'filter' => User::findUsersByGroup('manager')
        ],
        'label.name',
        'date_of_sale',
        [
            'attribute' => 'customer_id',
            'label' => 'Заказчик',
            'value' => 'customer.name',
            'filter' => ArrayHelper::map(Customer::find()->where(['status_id'=>1])->asArray()->all(),'id','name')
        ],
        [
            'attribute' => 'status_id',
            'filter' => \app\models\OrderStatus::$order_status
        ],

        'plan_circulation',
    ],
]);
ActiveForm::end();
?>
</div>
