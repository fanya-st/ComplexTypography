<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\OrderForm;
use app\models\Order;

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
        $orders = new ActiveDataProvider([
            'query' => Order::find()->orderBy(['date_of_create'=>SORT_DESC])->with('label'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
		return $this->render('list',compact('orders'));           
    }
	public function actionCreate($blank)
    {
        if(isset($blank) and $blank==1){
            $order = new OrderForm();
            if($order->load(Yii::$app->request->post()) ){
                if ($order->save()){
                    Yii::$app->session->setFlash('success','Заказ создан');
                    return $this-> refresh();
                }else{
                    Yii::$app->session->setFlash('error','Ошибка');
                }
            }
            return $this->render('create_blank', compact('order'));
        }
    }

}