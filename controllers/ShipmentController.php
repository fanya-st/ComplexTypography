<?php


namespace app\controllers;


use app\models\FinishedProductsWarehouse;
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
                        'actions' => ['create','list','view'],
                        'roles' => ['manager'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete','order-add','mark-defect-roll','close-shipment'],
                        'roles' => ['updateOwnShipmentManager','manager_admin'],
                        'roleParams' => function() {
                            return ['customer' => Shipment::findOne(['id' => Yii::$app->request->get('id')])];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view','send-shipment','mark-defect-roll','close-shipment'],
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

//        $shipment_roll=new ActiveDataProvider([
//            'query' => FinishedProductsWarehouse::find()
//                ->indexBy('id')
//                ->where(['order_id'=>ShipmentOrder::find()->select('order_id')->where(['shipment_id'=>$id])->column()])
//            ,
//            'pagination' => [
//                'pageSize' => 20,
//            ],
//        ]);
        $shipment_roll=FinishedProductsWarehouse::find()->where(['order_id'=>ShipmentOrder::find()->select('order_id')->where(['shipment_id'=>$id])->column()])->all();

        $route_customers = new ActiveDataProvider([
            'query' => Customer::find()->where(['id'=>$shipment->customer]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        if(Yii::$app->request->post()){
            return Yii::$app->runAction('shipment/mark-defect-roll',compact('shipment_roll'));
//            if (FinishedProductsWarehouse::loadMultiple($shipment_roll, $this->request->post()) && FinishedProductsWarehouse::validateMultiple($shipment_roll)) {
//                foreach ($shipment_roll as $roll) {
//                    if ($roll->defect_roll_count <= $roll->sended_roll_count) {
//                        $roll->save(false);
//                    }
//                    else {
//                        Yii::$app->session->setFlash('error', 'Ошибка');
//                        return $this->refresh();
//                    }
//                }
//            }
        }
        return $this->render('view',compact('shipment','orders','shipment_roll','route_customers'));
    }

    public function actionDelete($id)
    {
        $shipmentorder = ShipmentOrder::findOne(['order_id'=>$id]);
        if($shipmentorder->delete()) Yii::$app->session->setFlash('success', 'Успешно');
            else Yii::$app->session->setFlash('error', 'Ошибка');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMarkDefectRoll(array $shipment_roll)
    {
        if (FinishedProductsWarehouse::loadMultiple($shipment_roll, $this->request->post()) && FinishedProductsWarehouse::validateMultiple($shipment_roll)) {
                foreach ($shipment_roll as $roll) {
                    if ($roll->defect_roll_count <= $roll->sended_roll_count) {
                        $roll->save(false);
                    }
                    else {
                        Yii::$app->session->setFlash('error', 'Ошибка');
                    }
                }
            }
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
        if ($shipment->readyToSend!=true)Yii::$app->session->setFlash('error', 'Заказы должны быть на складе готовой продукции');
        else {
            foreach($shipment->finishedProductsWarehouse as $roll){
                if($roll->roll_count>$roll->sended_roll_count) { //проверяем кол-во отправленных роликов и если меньше количества всего роликов, то создаем строку с остаточными роликами
                    $new_roll=new FinishedProductsWarehouse();
                    $new_roll->roll_count=$roll->roll_count-$roll->sended_roll_count; //остаточные ролики от разницы
                    $new_roll->label_id=$roll->label_id;
                    $new_roll->previous_order_id=$roll->order_id;
                    $new_roll->label_in_roll=$roll->label_in_roll;
                    $new_roll->save();
                    $roll->roll_count=$roll->roll_count-$new_roll->roll_count;
                    $roll->packed_roll_count=$roll->packed_roll_count-$new_roll->roll_count;
                    $roll->save();
                }
            }
            $shipment->status_id=1;
            $shipment->save();
            Yii::$app->session->setFlash('success', 'Отправлено');
        }
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

    public function actionCloseShipment($id)
    {
        $shipment = Shipment::findOne($id);
            foreach($shipment->finishedProductsWarehouse as $roll){
                if(!empty($roll->defect_roll_count)) { //проверяем кол-во дефектных
                    $new_roll=new FinishedProductsWarehouse();
                    $new_roll->roll_count=$roll->defect_roll_count; //остаточные ролики от разницы
                    $new_roll->label_id=$roll->label_id;
                    $new_roll->previous_order_id=$roll->order_id;
                    $new_roll->label_in_roll=$roll->label_in_roll;
                    $new_roll->defect_roll_count=$roll->defect_roll_count;
                    $new_roll->defect_note=$roll->defect_note;
                    $new_roll->save();
                    $roll->roll_count=$roll->roll_count-$new_roll->roll_count;
                    $roll->packed_roll_count=$roll->packed_roll_count-$new_roll->roll_count;
                    $roll->sended_roll_count=$roll->sended_roll_count-$new_roll->roll_count;
                    $roll->defect_roll_count=null;
                    $roll->defect_note=null;
                    $roll->save();
                }
            }
            $shipment->status_id=2;
            $shipment->save();
            Yii::$app->session->setFlash('success', 'Закрыт');
        return $this->redirect(['shipment/view','id'=>$id]);
    }

}