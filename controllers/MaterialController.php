<?php


namespace app\controllers;


use app\models\OrderMaterial;
use app\models\PaperWarehouse;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use app\models\Order;
use yii\web\Controller;
use yii;

class MaterialController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['paper-consumption','barcode-print'],
                        'roles' => ['printer'],
                    ],

                ],
            ],
        ];
    }
    public function actionPaperConsumption($id){
            $order = Order::findOne($id);
            $new_used_paper=new OrderMaterial();
            $used_paper=OrderMaterial::find()->where(['order_id'=>$id])->all();
            if ($new_used_paper->load(Yii::$app->request->post()) && $new_used_paper->validate()) {
                $paper_from_warehouse=PaperWarehouse::findOne($new_used_paper->paper_warehouse_id);
                if($new_used_paper->length<=$paper_from_warehouse->length){
                    $new_used_paper->order_id=$id;
                    if ($new_used_paper->save()) {
                        $paper_from_warehouse->length=$paper_from_warehouse->length-$new_used_paper->length;
                        $paper_from_warehouse->save();
                        Yii::$app->session->setFlash('success', 'Расход введен');
                        return $this->refresh();
                    }else {
                        Yii::$app->session->setFlash('error', 'Ошибка ввода расхода');
                    }
                }else {
                    Yii::$app->session->setFlash('error', 'В ролике нет столько метража');
                }
            }
            return $this->render('paper-consumption',compact('order','new_used_paper','used_paper'));
    }
}