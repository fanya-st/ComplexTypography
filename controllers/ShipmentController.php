<?php


namespace app\controllers;


use app\models\Order;
use app\models\Shipment;
use app\models\ShipmentOrder;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Customer;
use app\models\OrderShipmentSearch;
use yii;
use app\models\ShipmentSearch;

class ShipmentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create','list','view','update'],
                        'roles' => ['manager'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete','order-add'],
                        'roles' => ['updateOwnShipmentManager','manager_admin'],
                        'roleParams' => function() {
                            return ['customer' => Shipment::findOne(['id' => Yii::$app->request->get('id')])];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view','send-shipment'],
                        'roles' => ['logistician'],
                    ],

                ],
            ],
        ];
    }

    public function actionList()
    {
        $new_shipment = new Shipment();
        if ($new_shipment->load(Yii::$app->request->post()) && $new_shipment->validate()) {
            return Yii::$app->runAction('shipment/create',compact('new_shipment'));
        }
        $searchModel = new ShipmentSearch();
        $shipments = $searchModel->search(Yii::$app->request->post());
        return $this->render('list',compact('shipments','searchModel','new_shipment'));
    }

    public function actionView($id)
    {
        $shipment = Shipment::findOne($id);
        $orders = new ActiveDataProvider([
            'query' => Order::find()->joinWith('label')->where(['order.id'=>ShipmentOrder::find()->select('order_id')->where(['shipment_id'=>$shipment->id])->column()])
                ->orderBy(['label.customer_id'=>SORT_ASC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

//        $add_order=new ActiveDataProvider([
//            'query' => Order::find()->where(['not',['order.id'=>ShipmentOrder::find()->select('order_id')->column()]])
//                ->joinWith('customer')->andWhere(['customer.manager_login'=>Yii::$app->user->identity->username]),
//            'pagination' => [
//                'pageSize' => 20,
//            ],
//        ]);

        $route_customers = new ActiveDataProvider([
            'query' => Customer::find()->where(['id'=>$shipment->customer]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('view',compact('shipment','orders','add_order','route_customers','searchModel'));
    }

    public function actionDelete($id)
    {
        $shipmentorder = ShipmentOrder::findOne(['order_id'=>$id]);
        if($shipmentorder->delete()) Yii::$app->session->setFlash('success', 'Успешно');
            else Yii::$app->session->setFlash('error', 'Ошибка');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionOrderAdd($id)
    {
        $shipment = Shipment::findOne($id);
        $searchModel = new OrderShipmentSearch();
        $add_order = $searchModel->search(Yii::$app->request->post());
        if(Yii::$app->request->post('selection')){
            $selected=Yii::$app->request->post('selection');
            foreach($selected as $order_id){
                $current_shipment=Shipment::findOne($id);
                $o=Order::findOne($order_id);
                if($current_shipment->manager_login==$o->customer->manager_login){
                    $new_shipment_order=new ShipmentOrder();
                    $new_shipment_order->order_id=$order_id;
                    $new_shipment_order->shipment_id=$id;
                    $new_shipment_order->save();
                }else
                    Yii::$app->session->setFlash('error', 'Не ваш заказ');

            }
            return $this->redirect(['shipment/view','id'=>$id]);
//            return Yii::$app->runAction('shipment/order-add',compact('selected','id'));
        }

        return $this->render('_order_add_tab',compact('add_order','searchModel','shipment'));
    }

    public function actionCreate($new_shipment)
    {
            $new_shipment->manager_login=Yii::$app->user->identity->username;
            if($new_shipment->save()){
                Yii::$app->session->setFlash('success', 'Создана отгрузка');
            }else
                Yii::$app->session->setFlash('error', 'Ошибка');
        return $this->redirect(['shipment/list']);
    }

    public function actionSendShipment($id)
    {
        $shipment = Shipment::findOne($id);
        $shipment->status_id=1;
        if ($shipment->readyToSend!=true)Yii::$app->session->setFlash('error', 'Заказы должны быть на складе готовой продукции');
        else Yii::$app->session->setFlash('success', 'Отправлено');
//        foreach ($shipment->order as $o){
//            if ($o->status_id !=8) {
//
//                break 1;
//            }
//        }
//            if($new_shipment->save()){
//                Yii::$app->session->setFlash('success', 'Создана отгрузка');
//            }else
        return $this->redirect(['shipment/view','id'=>$id]);
    }

}