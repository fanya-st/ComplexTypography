<?php

namespace app\controllers;

use app\models\LabelForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\OrderForm;
use app\models\Order;
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
                    'actions' => ['list','create'],
                    'roles' => ['manager'],
                ],
                [
                    'allow' => true,
                    'actions' => ['list','view'],
                    'roles' => ['designer','prepress'],
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
//        $orders = new ActiveDataProvider([
//            'query' => Order::find()->orderBy(['date_of_create'=>SORT_DESC])->with('label'),
//            'pagination' => [
//                'pageSize' => 10,
//            ],
//        ]);
//		return $this->render('list',compact('orders'));
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