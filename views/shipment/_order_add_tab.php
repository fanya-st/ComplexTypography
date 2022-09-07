<?php
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\models\User;
use app\models\Customer;
use yii\helpers\ArrayHelper;

$this->title = 'Работа с отгрузками';
$this->params['breadcrumbs'][] = ['label' => 'Работа с отгрузками', 'url' => ['shipment/list']];
$this->params['breadcrumbs'][] = ['label' => 'Отгрузка ID['.$shipment->id.'] ', 'url' => ['shipment/view','id'=>$shipment->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
<?php
$form=ActiveForm::begin(['method'=>'post']);
echo Html::submitButton('Добавить',['class'=>'btn btn-primary']);
?>
<div class="table-responsive">
<? echo GridView::widget([
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
            'attribute' => 'customerId',
            'value' => 'customer.name',
            'filter' => ArrayHelper::map(Customer::find()->where(['status_id'=>1])->asArray()->all(),'id','name')
        ],
        'order.status_id',
        'plan_circulation',
//        'circulationCountSend',
    ],
]);
ActiveForm::end();
?>
</div>
