<?php

namespace app\controllers;

use app\models\FinishedProductsWarehouse;
use app\models\Form;
use app\models\OrderPrintEndForm;
use yii\data\ActiveDataProvider;
use app\models\Label;
use app\models\Order;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\OrderForm;
use app\models\OrderSearch;
use yii\base\Model;
use yii\web\ForbiddenHttpException;

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
                    'actions' => ['list','create','view','create-blank','add-from-fpwarehouse','update'],
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
                    'actions' => ['list','view','start-pack','pack','pack-in','finish-pack','print-label-package','print-box-label','print-sleeve-label','pack-send'],
                    'roles' => ['packer'],
                ],
                [
                    'allow' => true,
                    'actions' => ['list','view'],
                    'roles' => ['accountant'],
                ],
				
            ],
        ],
//        'cache'=>[
//            'class' => 'yii\filters\PageCache',
//            'only' => ['list'],
//            'duration' => 60,
//            'dependency' => [
//                'class' => 'yii\caching\DbDependency',
//                'sql' => 'SELECT COUNT(*) FROM'. Order::tableName(),
//            ],
//        ],
    ];
}
	public function actionList()
    {
        $searchModel = new OrderSearch();
        $orders = $searchModel->search($this->request->post());
        return $this->render('list',compact('orders','searchModel'));
    }

    public function actionUpdate($id){
        $order = Order::findOne($id);
        if (!\Yii::$app->user->can('updateOrder', ['item' => $order->label->customer])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        if ($order->status_id>=2) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        if($order->load($this->request->post()) && $order->validate() && $order->save()){
            return $this->redirect(['view', 'id' => $order->id]);
        }
        return $this->render('update',compact('order'));
    }

    public function actionView($id)
    {
        $order = Order::findOne($id);
        $label = Label::findOne($order->label_id);
        $surplus = new ActiveDataProvider([
            'query' => FinishedProductsWarehouse::find()->where(['order_id'=>null,'label_id'=>$order->label_id]),
        ]);
        $roll = new ActiveDataProvider([
            'query' => FinishedProductsWarehouse::find()->where(['order_id'=>$id]),
        ]);
            if(Yii::$app->request->post('selection') && Yii::$app->request->post('add_from_fpwarehouse', 'start')){
                    return $this->runAction('add-from-fpwarehouse', compact('id'));
            }
        return $this->render('view',compact('order','label','surplus','roll'));
    }
    public function actionAddFromFpwarehouse($id)
    {
        $order=Order::findOne($id);
        if (!\Yii::$app->user->can('updateOrder', ['item' => $order->label->customer])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
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
        if ($order->label->status_id!=10 OR $order->status_id !=1) {
            throw new ForbiddenHttpException('Этикетка не готова к печати');
        }
            $order->status_id=2;
            $order->printer_id=Yii::$app->user->identity->getId();
            $order->date_of_print_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            if (!empty($order->combinatedPrintOrder)){
                foreach ($order->combinatedPrintOrder as $com_ord){
                    if($com_ord->order_id!=$id){
                        $o=Order::findOne($com_ord->order_id);
                        $o->printer_id=Yii::$app->user->identity->getId();
                        $o->date_of_print_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                        $o->status_id=2;
                        $o->save();
                    }
                }
            }
            if($order->validate() && $order->save()){
                Yii::$app->session->setFlash('success','Заказ в печати');
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }

        return $this->redirect(['order/view','id'=>$id]);
    }

    public function actionStartPrintVariable($id)
    {
        $order=Order::findOne($id);
        if ($order->label->status_id!=10) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
            $order->status_id=2;
            $order->date_of_variable_print_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            $order->save();
            Yii::$app->session->setFlash('success','Заказ в печати');

        return $this->redirect(['order/view','id'=>$id]);
    }
    public function actionStartRewind($id)
    {
        $order=Order::findOne($id);

        if ($order->status_id!=4) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
            $order->status_id=5;
            $order->rewinder_id=Yii::$app->user->identity->getId();
            $order->date_of_rewind_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            $order->save();
            if (!empty($order->combinatedPrintOrder)){
                foreach ($order->combinatedPrintOrder as $com_ord){
                    if($com_ord->order_id!=$id){
                        $order=Order::findOne($com_ord->order_id);
                        $order->rewinder_id=Yii::$app->user->identity->getId();
                        $order->date_of_rewind_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                        $order->status_id=5;
                        $order->save();
                    }
                }
            }
            Yii::$app->session->setFlash('success','Заказ в нарезке');

        return $this->redirect(['order/view','id'=>$id]);
    }
    public function actionStartPack($id)
    {
        $order = Order::findOne($id);
        if ($order->status_id!=6) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
            $order->status_id = 7;
            $order->packer_id=Yii::$app->user->identity->getId();
            $order->date_of_packing_begin=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            if ($order->save())
                Yii::$app->session->setFlash('success', 'Заказ в упаковке');
            else
                Yii::$app->session->setFlash('error', 'Заказ не нарезан и не перемотан');
        return $this->redirect(['order/view','id'=>$id]);
    }
    public function actionPausePrint($id)
    {
        $order=Order::findOne($id);
        if ($order->status_id!=2) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
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
        if ($order->status_id!=3) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
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
                return $this->render('print-box-label', compact('order','finished_products'));
            }
        }
        return $this->render('print-label-package-form', compact('order','finished_products'));
    }

    //завершить печать и ввести получившиеся ролики
    public function actionFinishPrint($id)
    {
        $order=OrderPrintEndForm::findOne($id);
        if ($order->status_id<2 OR $order->status_id>2) {
            throw new ForbiddenHttpException('Заказ не находиться в печати чтобы завершить печать');
        }
        if($order->load(Yii::$app->request->post()) && $order->validate()){
            $order->status_id=4;
            $order->date_of_print_end=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
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
            if($order->save())
            Yii::$app->session->setFlash('success','Печать закончена');
            return $this->redirect(['order/view','id'=>$id]);
        }
        return $this->render('finish-print', compact('order'));
    }

    public function actionFinishPrintVariable($id)
    {
        $order=Order::findOne($id);
        $label=Label::findOne($order->label_id);
        if($label->load(Yii::$app->request->post()) && $label->validate()){
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
        if ($order->status_id!=5 ) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $order->status_id=6;
        $order->date_of_rewind_end=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
        $order->save();
        return $this->redirect(['order/view','id'=>$id]);
    }
    public function actionRewind($id)
    {
        $order=Order::findOne($id);
        if ($order->status_id!=5 ) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $order_roll = new ActiveDataProvider([
        'query' => FinishedProductsWarehouse::find()->where(['order_id'=>$id])
    ]);
        $new_roll=new FinishedProductsWarehouse();
        $new_roll->order_id=$id;
        $new_roll->label_id=$order->label_id;
        if($new_roll->load(Yii::$app->request->post()) && $new_roll->validate()){
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
        if ($order->status_id !=7 ) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
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

    public function actionPackSend($id)
    {
        $order=Order::findOne($id);
//        if ($order->status_id !=7 ) {
//            throw new ForbiddenHttpException('Доступ запрещен');
//        }
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
        return $this->render('pack-send', compact('order','order_roll'));
    }
    public function actionFinishPack($id)
    {
            $order=Order::findOne($id);
        if ($order->status_id !=7 ) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
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
        return $this->goBack();
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
            }
            if ($order->save()){
                return $this->redirect(['order/view','id'=>$order->id]);
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
        }
        return $this->render('create', compact('order'));

    }


    /*Создание нового заказа для пустышек*/
    public function actionCreateBlank(){
        $order = new OrderForm();
            $label=new Label();
            if($order->load(Yii::$app->request->post()) && $label->load(Yii::$app->request->post())){
                $label->status_id=10;
                if($label->validate() && $order->validate()){
                    if ($label->save()){
                        $order->label_id=$label->id;
                        if ($order->save()){
                            return $this->redirect(['order/view','id'=>$order->id]);
                        }else{
                            Yii::$app->session->setFlash('error','Ошибка');
                        }
                    }
                }
            }
            return $this->render('create-blank', compact('order','label'));

    }

}