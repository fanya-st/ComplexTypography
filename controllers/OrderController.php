<?php

namespace app\controllers;

use app\models\CombinationOrder;
use app\models\CombinationPrintOrder;
use app\models\Label;
use app\models\LabelForm;
use app\models\Order;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\OrderForm;
use app\models\OrderSearch;

class OrderController extends Controller
{
	public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['list','create','view'],
                    'roles' => ['manager'],
                ],
                [
                    'allow' => true,
                    'actions' => ['list','view','start-print','pause-print','finish-print'],
                    'roles' => ['printer'],
                ],
                [
                    'allow' => true,
                    'actions' => ['combinate-order'],
                    'roles' => ['updateOwnOrderManager','manager_admin'],
                    'roleParams' => function() {
                        return ['order' => Order::findOne(['id' => Yii::$app->request->get('id')])];
                    },
                ],
				
            ],
        ],
    ];
}
	public function actionList()
    {
        $searchModel = new OrderSearch();
        $orders = $searchModel->search(Yii::$app->request->post());
        return $this->render('list',compact('orders','searchModel'));
    }
    public function actionView($id)
    {
        $order = Order::findOne($id);
        $label = Label::findOne($order->label_id);
        return $this->render('view',compact('order','label'));
    }
//    public function actionSelectedOrderProcess()
//    {
//        if(Yii::$app->request->post('selection')){
//            $selected=Yii::$app->request->post('selection');
//            if(Yii::$app->request->post('combinated-print') && count(Yii::$app->request->post('selection'))>=2){
//                $combination=new CombinationPrintOrder();
//                $combination->save();
//                foreach ($selected as $select){
//                    if($old_combination_order=CombinationOrder::findOne(['order_id'=>$select]))
//                    $old_combination_order->delete();
//                    $combination_order=new CombinationOrder();
//                    if(Order::findOne($select)->status_id==1){
//                        $combination_order->order_id=$select;
//                        $combination_order->combination_id=$combination->id;
//                        $combination_order->save();
//                    }
//                }
//                Yii::$app->session->setFlash('success','Совместная печать принята');
//            }
//            if(Yii::$app->request->post('combinated-print-unset')){
//                foreach ($selected as $select){
//                    if(Order::findOne($select)->status_id==1){
//                        $old_combination_order=CombinationOrder::findOne(['order_id'=>$select]);
//                        $old_combination_order->delete();
//                    }
//                }
//                Yii::$app->session->setFlash('success','Совместная печать отменена');
//            }
//        }
//        return $this->redirect(['order/list']);
//    }
public function actionCombinateOrder($id)
    {
        $order=Order::findOne($id);
        $com_temp=new CombinationOrder();
        if ($order->status_id==1){
            if($com_temp->load(Yii::$app->request->post())){
                $combination_order=new CombinationPrintOrder();
                $combination_order->save();
                foreach($com_temp->order_id as $or_id){
                    if($old_combination_order=CombinationOrder::findOne(['order_id'=>$or_id]))
                        $old_combination_order->delete();
                    $com=new CombinationOrder();
                    $com->order_id=$or_id;
                    $com->combination_id=$combination_order->id;
                    $com->save();
                }
                if($old_combination_order=CombinationOrder::findOne(['order_id'=>$id]))
                    $old_combination_order->delete();
                $com=new CombinationOrder();
                $com->order_id=$id;
                $com->combination_id=$combination_order->id;
                $com->save();
                Yii::$app->session->setFlash('success','Совмещение создано');
                return $this->redirect(['order/view','id'=>$id]);
            }
        }else{
            Yii::$app->session->setFlash('error','Ошибка заказ не новый');
            return $this->redirect(['order/view','id'=>$id]);
        }

        return $this->render('combinate_order', compact('order','com_temp'));
    }
	public function actionCreate($blank,$label_id=null)
    {
        if(isset($blank) and $blank==1){
            $order = new OrderForm();
            $label=new LabelForm();
            if($order->load(Yii::$app->request->post())&&$label->load(Yii::$app->request->post())){
                if ($label->save()){
                    $order->label_id=$label->id;
                }
                if ($order->save()){
                    Yii::$app->session->setFlash('success','Заказ создан');
                    return $this-> refresh();
                }else{
                    Yii::$app->session->setFlash('error','Ошибка');
                }
            }
            return $this->render('create_blank', compact('order','label'));
        }
        if(isset($blank) and $blank==0){
            $order = new OrderForm();
            $new_label = new LabelForm();
            if(isset($label_id)){$order->label_id=$label_id;}
            if($order->load(Yii::$app->request->post()) && $new_label->load(Yii::$app->request->post())){
                if($new_label->parent_label==1){
                    $new_label=LabelForm::findOne($order->label_id);
                    $new_label->parent_label=$order->label_id;
                    unset($new_label->id);
                    unset($new_label->date_of_create);
                    unset($new_label->status_id);
                    $new_label->setisNewRecord(true);
                    $new_label->save();
                    $order->label_id=$new_label->id;
                }
                if ($order->save()){
                    Yii::$app->session->setFlash('success','Заказ создан');
                    return $this-> refresh();
                }else{
                    Yii::$app->session->setFlash('error','Ошибка');
                }
            }
            return $this->render('create', compact('order','new_label'));
        }
    }

}