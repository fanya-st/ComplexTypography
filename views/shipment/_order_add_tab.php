<?php
use yii\grid\GridView;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\models\User;
use app\models\Customer;
use yii\helpers\ArrayHelper;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

$this->title = 'Работа с отгрузками';
$this->params['breadcrumbs'][] = ['label' => 'Работа с отгрузками', 'url' => ['shipment/list']];
$this->params['breadcrumbs'][] = ['label' => 'Отгрузка ID['.$shipment->id.'] ', 'url' => ['shipment/view','id'=>$shipment->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
<?php
$form=ActiveForm::begin(['method'=>'post']);
echo Html::submitButton('Добавить',['class'=>'btn btn-primary']);
echo GridView::widget([
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
            'attribute' => 'manager_login',
            'value' => function($model){
                return User::getFullNameByUsername($model->customer->manager_login);
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
        'orderStatus.name',
        'mashine.name',
        'plan_circulation',
        'circulationCountSend',
    ],
]);
ActiveForm::end();
?>