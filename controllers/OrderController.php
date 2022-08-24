<?php

namespace app\controllers;

use app\models\CombinationOrder;
use app\models\FinishedProductsWarehouse;
use app\models\Form;
use app\models\OrderPrintEndForm;
use app\models\PrintLabelPackage;
use app\models\ShipmentOrder;
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
use barcode\barcode\BarcodeGenerator;
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
                    'actions' => ['list','create','view','create-blank'],
                    'roles' => ['manager'],
                ],
                [
                    'allow' => true,
                    'actions' => ['list','view','start-print','start-print-variable','pause-print','finish-print','finish-print-variable','continue-print','form-defect'],
                    'roles' => ['printer'],
                ],
                [
                    'allow' => true,
                    'actions' => ['list','view','start-rewind','finish-rewind','rewind','rewind-delete'],
                    'roles' => ['rewinder'],
                ],
                [
                    'allow' => true,
                    'actions' => ['list','view','start-pack','pack','pack-in','finish-pack','print-label-package','print-box-label','print-sleeve-label'],
                    'roles' => ['packer'],
                ],
                [
                    'allow' => true,
                    'actions' => ['add-from-fpwarehouse'],
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
        $surplus = new ActiveDataProvider([
            'query' => FinishedProductsWarehouse::find()->where(['order_id'=>null,'label_id'=>$order->label_id]),
        ]);
            if(Yii::$app->request->post('selection') && Yii::$app->request->post('add_from_fpwarehouse', 'start')){
                    return $this->runAction('add-from-fpwarehouse', compact('id'));
            }
        return $this->render('view',compact('order','label','surplus'));
    }
    public function actionAddFromFpwarehouse($id)
    {
                $rolls=FinishedProductsWarehouse::find()->where(['id'=>Yii::$app->request->post('selection')])->all();
                foreach($rolls as $roll){
                     $roll->order_id=$id;
                     $roll->save();
                }
                Yii::$app->session->setFlash('success','Добавлено в заказ');
        return $this->redirect(['order/view','id'=>$id]);
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

    public function actionStartPrintVariable($id)
    {
        $order=Order::findOne($id);
        if($order->label->status_id==10){
            $order->status_id=2;
            $order->date_of_variable_print_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            $order->save();
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

    public function actionPrintLabelPackage($id)
    {
        $order=Order::findOne($id);
        $finished_products=FinishedProductsWarehouse::find()->where(['order_id'=>$order->id])->indexBy('id')->all();
//        if(Yii::$app->request->post('print_box_label')=='' && $model->load(Yii::$app->request->post())){
//                return $this->render('print-box-label', compact('order','model'));
//        }
        if(Yii::$app->request->post('print_box_label')==''){
            if (Model::loadMultiple($finished_products, Yii::$app->request->post())){
                return $this->render('print-box-label', compact('order','model','finished_products'));
            }
        }
        return $this->render('print-label-package-form', compact('order','model','finished_products'));
    }


    public function actionFinishPrint($id)
    {
        $order=OrderPrintEndForm::findOne($id);
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

    public function actionFinishPrintVariable($id)
    {
        $order=Order::findOne($id);
        $label=Label::findOne($order->label_id);
        if($label->load(Yii::$app->request->post()) && $label->validate(Yii::$app->request->post())){
            $order->status_id=4;
            $order->date_of_variable_print_end=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            $order->save();
            $label->save();
            Yii::$app->session->setFlash('success','Печать закончена');
            return $this->redirect(['order/view','id'=>$id]);
        }
        return $this->render('finish-print-variable', compact('label','order'));
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
                    if ($roll->packed_roll_count<=$roll->roll_count){
                        $roll->save(false);
                    }
                    else
                        Yii::$app->session->setFlash('error','Нет такого количества смотанных роликов');
                }
                return $this->refresh();
            }
        return $this->render('pack', compact('order','order_roll'));
    }
    public function actionFinishPack($id)
    {
            $order=Order::findOne($id);
            $order->status_id=8;
            $order->date_of_packing_end=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            if ($order->save()) {
                Yii::$app->session->setFlash('success','Упаковка завершена');
                return $this->redirect(['order/view','id'=>$id]);
            }else {
                Yii::$app->session->setFlash('error','Ошибка');
                return $this->redirect(['order/pack','id'=>$id]);
            }
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
    /*Создание нового заказа*/
    public function actionCreate($label_id=null){
        $order = new OrderForm();
        if(!empty($label_id))
            $order->label_id=$label_id;
        if($order->load(Yii::$app->request->post()) && $order->validate() ){
            //если галочка о внесении изменений то
            if($order->parent_label==1){
                //создаем на основе выбранной этикетки дочернюю со статусом новый
                $label=Label::findOne($order->label_id);
                $order->label_id=$label->createSubLabel();
                Yii::info("Создана этикетка пользователем ".Yii::$app->user->identity->username.' №'.$label->id);
            }
            if ($order->save()){
                Yii::info("Создана заказ пользователем ".Yii::$app->user->identity->username.' №'.$order->id);
                return $this->redirect(['order/view','id'=>$order->id]);
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
        }
        return $this->render('create', compact('order'));

    }


    /*Создание нового заказа для пустышек*/
    public function actionCreateBlank($label_id=null){
        $order = new OrderForm();
            $label=new Label();
            if($order->load(Yii::$app->request->post()) && $label->load(Yii::$app->request->post()) && $label->validate() && $order->validate()){
                $label->status_id=10;
                if ( $label->save()){
                    Yii::info("Создана этикетка пользователем ".Yii::$app->user->identity->username.' №'.$label->id);
                    $order->label_id=$label->id;
                }
                if ($order->save()){
                    Yii::info("Создана заказ пользователем ".Yii::$app->user->identity->username.' №'.$order->id);
                    return $this->redirect(['order/view','id'=>$order->id]);
                }else{
                    Yii::$app->session->setFlash('error','Ошибка');
                }
            }
            return $this->render('create-blank', compact('order','label'));

    }

//	public function actionCreate($blank,$label_id=null)
//    {
//        if(isset($blank) and $blank==1){
//            $order = new OrderForm();
//            $label=new LabelForm();
//            if($order->load(Yii::$app->request->post())
//                &&$label->load(Yii::$app->request->post())
//                &&$order->validate(Yii::$app->request->post())
//                &&$label->validate(Yii::$app->request->post())
//            ){
//                if ($label->save()){
//                    $order->label_id=$label->id;
//                }
//                if ($order->save()){
//                    Yii::$app->session->setFlash('success','Заказ создан');
//                    return $this-> refresh();
//                }else{
//                    Yii::$app->session->setFlash('error','Ошибка');
//                }
//            }
//            return $this->render('create_blank', compact('order','label'));
//        }
//        if(isset($blank) and $blank==0){
//            $order = new OrderForm();
//            $new_label = new LabelForm();
//            if(isset($label_id)){$order->label_id=$label_id;}
//            if($order->load(Yii::$app->request->post())
//                && $new_label->load(Yii::$app->request->post())
//                && $new_label->validate(Yii::$app->request->post())
//                && $order->validate(Yii::$app->request->post())){
//                if($new_label->parent_label==1){
//                    $new_label=LabelForm::findOne($order->label_id);
//                    $new_label->parent_label=$order->label_id;
//                    unset($new_label->id);
//                    unset($new_label->date_of_create);
//                    unset($new_label->status_id);
//                    $new_label->setisNewRecord(true);
//                    $new_label->save();
//                    $order->label_id=$new_label->id;
//                }
//                if ($order->save()){
//                    Yii::$app->session->setFlash('success','Заказ создан');
//                    return $this-> refresh();
//                }else{
//                    Yii::$app->session->setFlash('error','Ошибка');
//                }
//            }
//            return $this->render('create', compact('order','new_label'));
//        }
//    }

}