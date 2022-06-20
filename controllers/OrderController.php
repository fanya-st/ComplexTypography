<?php

namespace app\controllers;

use app\models\CombinationOrder;
use app\models\FinishedProductsWarehouse;
use app\models\Form;
use yii\data\ActiveDataProvider;
use app\models\CombinationPrintOrder;
use app\models\Label;
use app\models\LabelForm;
use app\models\Order;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\OrderForm;
use app\models\OrderSearch;
use yii\base\Model;

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
                    'actions' => ['list','view','start-print','pause-print','finish-print','continue-print','form-defect'],
                    'roles' => ['printer'],
                ],
                [
                    'allow' => true,
                    'actions' => ['list','view','start-rewind','finish-rewind','rewind','rewind-delete'],
                    'roles' => ['rewinder'],
                ],
                [
                    'allow' => true,
                    'actions' => ['list','view','start-pack','pack','pack-in','finish-pack'],
                    'roles' => ['packer'],
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
    public function actionStartPrint($id)
    {
        $order=Order::findOne($id);
        if($order->label->status_id==10){
            $order->status_id=2;
            $order->printer_login=Yii::$app->user->identity->username;
            $order->date_of_print_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            $order->save();
            if (!empty($order->combinatedPrintOrder)){
                foreach ($order->combinatedPrintOrder as $com_ord){
                    if($com_ord->order_id!=$id){
                        $order=Order::findOne($com_ord->order_id);
                        $order->printer_login=Yii::$app->user->identity->username;
                        $order->date_of_print_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                        $order->status_id=2;
                        $order->save();
                    }
                }
            }
            Yii::$app->session->setFlash('success','Заказ в печати');
        }else{
            Yii::$app->session->setFlash('error','Этикетка не готова к печати');
        }

        return $this->redirect(['order/view','id'=>$id]);
    }
    public function actionStartRewind($id)
    {
        $order=Order::findOne($id);
        if($order->status_id==4){
            $order->status_id=5;
            $order->rewinder_login=Yii::$app->user->identity->username;
            $order->date_of_rewind_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            $order->save();
            if (!empty($order->combinatedPrintOrder)){
                foreach ($order->combinatedPrintOrder as $com_ord){
                    if($com_ord->order_id!=$id){
                        $order=Order::findOne($com_ord->order_id);
                        $order->rewinder_login=Yii::$app->user->identity->username;
                        $order->date_of_rewind_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                        $order->status_id=5;
                        $order->save();
                    }
                }
            }
            Yii::$app->session->setFlash('success','Заказ в нарезке');
        }else{
            Yii::$app->session->setFlash('error','Заказ не отпечатан');
        }

        return $this->redirect(['order/view','id'=>$id]);
    }
    public function actionStartPack($id)
    {
        $order = Order::findOne($id);
        if ($order->status_id == 6) {
            $order->status_id = 7;
            $order->packer_login=Yii::$app->user->identity->username;
            $order->date_of_packing_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            if ($order->save())
                Yii::$app->session->setFlash('success', 'Заказ в упаковке');
            else
                Yii::$app->session->setFlash('error', 'Заказ не нарезан и не перемотан');
        }
        return $this->redirect(['order/view','id'=>$id]);
    }
    public function actionPausePrint($id)
    {
        $order=Order::findOne($id);
            $order->status_id=3;
            $order->save();
            if (!empty($order->combinatedPrintOrder)){
                foreach ($order->combinatedPrintOrder as $com_ord){
                    if($com_ord->order_id!=$id){
                        $order=Order::findOne($com_ord->order_id);
                        $order->status_id=3;
                        $order->save();
                    }
                }
            }
            Yii::$app->session->setFlash('success','Печать приостановлена');

        return $this->redirect(['order/view','id'=>$id]);
    }
    public function actionContinuePrint($id)
    {
        $order=Order::findOne($id);
            $order->status_id=2;
            $order->save();
            if (!empty($order->combinatedPrintOrder)){
                foreach ($order->combinatedPrintOrder as $com_ord){
                    if($com_ord->order_id!=$id){
                        $order=Order::findOne($com_ord->order_id);
                        $order->status_id=2;
                        $order->save();
                    }
                }
            }
            Yii::$app->session->setFlash('success','Печать продолжена');

        return $this->redirect(['order/view','id'=>$id]);
    }
    public function actionFinishPrint($id)
    {
        $order=Order::findOne($id);
        if($order->load(Yii::$app->request->post()) && $order->validate(Yii::$app->request->post())){
            $order->status_id=4;
            $order->date_of_print_end=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            $order->save();
            if (!empty($order->combinatedPrintOrder)){
                foreach ($order->combinatedPrintOrder as $com_ord){
                    if($com_ord->order_id!=$order->id){
                        $o=Order::findOne($com_ord->order_id);
                        $o->status_id=4;
                        $o->actual_circulation=$order->actual_circulation;
                        $o->date_of_print_end=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                        $o->save();
                    }
                }
            }
            Yii::$app->session->setFlash('success','Печать закончена');
            return $this->redirect(['order/view','id'=>$id]);
        }
        return $this->render('finish-print', compact('order'));
    }
    public function actionFinishRewind($id)
    {
        $order=Order::findOne($id);
        $order->status_id=6;
        $order->date_of_rewind_end=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
        $order->save();
        return $this->redirect(['order/view','id'=>$id]);
    }
    public function actionRewind($id)
    {
        $order=Order::findOne($id);
        $order_roll = new ActiveDataProvider([
        'query' => FinishedProductsWarehouse::find()->where(['order_id'=>$id])
    ]);
        $new_roll=new FinishedProductsWarehouse();
        $new_roll->order_id=$id;
        $new_roll->label_id=$order->label_id;
        if($new_roll->load(Yii::$app->request->post()) && $new_roll->validate(Yii::$app->request->post())){
            if($new_roll->save()){
                Yii::$app->session->setFlash('success','Добавлено');
                $this->refresh();
            }
            else
                Yii::$app->session->setFlash('error','Ошибка');

        }
        return $this->render('rewind', compact('order','order_roll','new_roll'));
    }
    public function actionPack($id)
    {
        $order=Order::findOne($id);
        $order_roll = FinishedProductsWarehouse::find()->where(['order_id' => $id])->indexBy('id')->all();
            if (FinishedProductsWarehouse::loadMultiple($order_roll, $this->request->post()) && FinishedProductsWarehouse::validateMultiple($order_roll)) {
                foreach ($order_roll as $roll) {
                    if ($roll->packed_count<=$roll->count){
                        $roll->save(false);
                        return $this->refresh();
                    }
                    else
                        Yii::$app->session->setFlash('error','Нет такого количества смотанных роликов');
                }
            }
        if ($order->load(Yii::$app->request->post())) {
            $order->status_id=8;
            $order->date_of_packing_end=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            if ($order->save()) {
                Yii::$app->session->setFlash('success','Упаковка завершена');
                return $this->redirect(['order/view','id'=>$id]);
            }
        }
        return $this->render('pack', compact('order','order_roll'));
    }
    public function actionRewindDelete($roll_id)
    {
        $roll=FinishedProductsWarehouse::findOne($roll_id);
        $roll->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionFormDefect($id)
    {
        $order=Order::findOne($id);
        $label=Label::findOne($order->label_id);
        if(isset($label->combination))
            $forms_id=Form::find()->select('id')->where(['combination_id'=>$label->combination->combination_id])->column();
        else $forms_id=Form::find()->select('id')->where(['label_id'=>$label->id])->column();
        $forms = new ActiveDataProvider([
            'query' => Form::find()->where(['id'=>$forms_id
                ,'ready'=>1
            ])
        ]);
        $form_temp = new Form();
        if($form_temp->load(Yii::$app->request->post()) && $form_temp->validate(Yii::$app->request->post()) ){
        if(Yii::$app->request->post('selection')){
                    $selected=Yii::$app->request->post('selection');
                    foreach ($selected as $select){
                        $f=Form::findOne($select);
                        $f->ready=0;
                        $f->form_defect_id=$form_temp->form_defect_id_temp;
                        $f->save();
                    }
            if(isset($label->combination))
                foreach ($label->combination->label_id as $label_id){
                    $l=Label::findOne($label_id);
                    $l->status_id=5;
                    $l->save();
                }
                else {
                    $label->status_id=5;
                    $label->save();
                }

                    if(!empty($order->combinationOrder))
                foreach ($order->combinatedPrintOrder as $order_id){
                    $o=Order::findOne($order_id->order_id);
                    $o->status_id=3;
                    $o->save();
                }
                else {
                    $order->status_id=3;
                    $order->save();
                }



            Yii::$app->session->setFlash('success','Формы отправлены в брак');
            $this->refresh();
                }
            }
        return $this->render('form-defect', compact('label','order','forms','form_temp','selected'));
    }

	public function actionCreate($blank,$label_id=null)
    {
        if(isset($blank) and $blank==1){
            $order = new OrderForm();
            $label=new LabelForm();
            if($order->load(Yii::$app->request->post())
                &&$label->load(Yii::$app->request->post())
                &&$order->validate(Yii::$app->request->post())
                &&$label->validate(Yii::$app->request->post())
            ){
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
            if($order->load(Yii::$app->request->post())
                && $new_label->load(Yii::$app->request->post())
                && $new_label->validate(Yii::$app->request->post())
                && $order->validate(Yii::$app->request->post())){
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