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
use app\models\OrderSearch;
use yii;
use app\models\ShipmentSearch;
use yii\web\ForbiddenHttpException;

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
                        'actions' => ['create','list','view','delete','order-add','mark-defect-roll','close-shipment','order-add'],
                        'roles' => ['manager'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view','send-shipment','mark-defect-roll','close-shipment','edit-transport'],
                        'roles' => ['logistician'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view'],
                        'roles' => ['accountant'],
                    ],

                ],
            ],
        ];
    }

    public function actionList()
    {
        $new_shipment = new Shipment();
        if ($new_shipment->load($this->request->post()) && $new_shipment->validate()) {
            return Yii::$app->runAction('shipment/create',compact('new_shipment'));
        }
        $searchModel = new ShipmentSearch();
        $shipments = $searchModel->search($this->request->post());
        return $this->render('list',compact('shipments','searchModel','new_shipment'));
    }

    public function actionView(int $id): string
    {
        $shipment = Shipment::findOne($id);
        $orders = new ActiveDataProvider([
            'query' => Order::find()->joinWith('label')->where(['order.id'=>ShipmentOrder::find()->select('order_id')->where(['shipment_id'=>$shipment->id])->column()])
                ->orderBy(['label.customer_id'=>SORT_ASC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $roll=FinishedProductsWarehouse::find()->where(['order_id'=>ShipmentOrder::find()->select('order_id')->where(['shipment_id'=>$id])->column()])->all();

        $route_customers = new ActiveDataProvider([
            'query' => Customer::find()->where(['id'=>$shipment->customer]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
//        if($this->request->isPost){
//
//        }
        return $this->render('view',compact('shipment','orders','roll','route_customers'));
    }

    /**
     * @throws \Throwable
     * @throws yii\db\StaleObjectException
     * @throws ForbiddenHttpException
     */
    public function actionDelete(int $id): yii\web\Response
    {
        $shipmentorder = ShipmentOrder::findOne(['order_id'=>$id]);
        $shipment=Shipment::findOne($shipmentorder->shipment_id);
        if (!\Yii::$app->user->can('updateShipment',['item'=>$shipment])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        if($shipmentorder->delete()) Yii::$app->session->setFlash('success', 'Успешно');
            else Yii::$app->session->setFlash('error', 'Ошибка');
//        return $this->redirect(Yii::$app->request->referrer);
        return $this->goBack();
    }

    public function actionEditTransport(int $id): yii\web\Response|string
    {
        $shipment = Shipment::findOne($id);
        if($this->request->isPost){
            if($shipment->load($this->request->post()) && $shipment->validate()){
                if($shipment->save())
                    return $this->redirect(['shipment/view','id'=>$id]);
            }
        }
        return $this->render('edit-transport',compact('shipment'));
    }

    public function actionMarkDefectRoll(int $id): yii\web\Response|string
    {
        $shipment = Shipment::findOne($id);
        $shipment_roll=FinishedProductsWarehouse::find()->where(['order_id'=>ShipmentOrder::find()
            ->select('order_id')->where(['shipment_id'=>$id])->column()])->all();
        if($this->request->isPost){
            if (FinishedProductsWarehouse::loadMultiple($shipment_roll, $this->request->post()) && FinishedProductsWarehouse::validateMultiple($shipment_roll)) {
                foreach ($shipment_roll as $roll) {
                    if ($roll->defect_roll_count <= $roll->sended_roll_count) {
                        if($roll->save(false))
                            return $this->redirect(['shipment/view','id'=>$id]);
                    }
                    else {
                        Yii::$app->session->setFlash('error', 'Ошибка');
                    }
                }
            }
        }
        return $this->render('mark-defect',compact('shipment_roll','shipment'));
    }

    public function actionOrderAdd(int $id): yii\web\Response|string
    {
        $shipment = Shipment::findOne($id);
        if (!\Yii::$app->user->can('updateShipment', ['item' => $shipment])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $searchModel = new OrderSearch();
        $add_order = $searchModel->search($this->request->post());
        if(Yii::$app->request->post('selection')){
            $selected=Yii::$app->request->post('selection');
            foreach($selected as $order_id){
                $current_shipment=Shipment::findOne($id);
                $o=Order::findOne($order_id);
                if($current_shipment->manager_id==$o->customer->user_id){
                    $new_shipment_order=new ShipmentOrder();
                    $new_shipment_order->order_id=$order_id;
                    $new_shipment_order->shipment_id=$id;
                    $new_shipment_order->save();
                }else
                    Yii::$app->session->setFlash('error', 'Не ваш заказ');

            }
            return $this->redirect(['shipment/view','id'=>$id]);
        }

        return $this->render('_order_add_tab',compact('add_order','searchModel','shipment'));
    }

    public function actionCreate(Shipment $new_shipment): yii\web\Response
    {
            $new_shipment->manager_id=Yii::$app->user->identity->getId();
            if($new_shipment->save()){
                Yii::$app->session->setFlash('success', 'Создана отгрузка');
            }else
                Yii::$app->session->setFlash('error', 'Ошибка');
        return $this->redirect(['shipment/list']);
    }

    public function actionSendShipment(int $id): yii\web\Response
    {
        $shipment = Shipment::findOne($id);
        if ($shipment->status_id!=0) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
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
                    if($roll->roll_count<=0)
                        $roll->delete();
                    else
                        $roll->save();
                }
            }
            $shipment->status_id=1;
            $shipment->date_of_send=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            $shipment->save();
            Yii::$app->session->setFlash('success', 'Отправлено');
        }
        return $this->redirect(['shipment/view','id'=>$id]);
    }

    public function actionCloseShipment(int $id): yii\web\Response
    {
        $shipment = Shipment::findOne($id);
        if ($shipment->status_id!=1) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
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
                    if($roll->roll_count<=0)
                        $roll->delete();
                    else
                        $roll->save();
                }
            }
            $shipment->status_id=2;
            $shipment->date_of_close=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            $shipment->save();
            Yii::$app->session->setFlash('success', 'Закрыт');
        return $this->redirect(['shipment/view','id'=>$id]);
    }

}