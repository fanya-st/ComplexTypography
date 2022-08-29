<?php


namespace app\controllers;


use app\models\Customer;
use app\models\Region;
use app\models\Town;
use app\models\Street;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\CustomerForm;
use yii;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use app\models\CustomerSearch;
use yii\web\ForbiddenHttpException;

class CustomerController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create','region','town','street','list','view','update'],
                        'roles' => ['manager'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $customer = new CustomerForm();
        $customer->status_id=1;
        $customer->manager_login=Yii::$app->user->identity->username;
        if ($customer->load(Yii::$app->request->post()) && $customer->validate()) {
            if($customer->save()){
                Yii::$app->session->setFlash('success', 'Заказчик добавлен');
                return $this->refresh();
            }
            else
                Yii::$app->session->setFlash('error', 'Ошибка');
        }
        return $this->render('create',compact('customer'));
    }

    public function actionUpdate($id)
    {
        $customer = CustomerForm::findOne($id);
        if (!\Yii::$app->user->can('updateCustomer',['item'=>$customer])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        if ($customer->load(Yii::$app->request->post()) && $customer->validate(Yii::$app->request->post())) {
            if($customer->save()){
                Yii::$app->session->setFlash('success', 'Обновлено');
                return $this->refresh();
            }
            else
                Yii::$app->session->setFlash('error', 'Ошибка');
        }
        return $this->render('update',compact('customer'));
    }
    public function actionView($id)
    {
        $customer = Customer::findOne($id);
        return $this->render('view',compact('customer'));
    }

    public function actionRegion() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            if ($_POST['depdrop_parents'] != null) {
                $subject_id = end($_POST['depdrop_parents']);
                foreach (ArrayHelper::map(Region::find()->where(['subject_id'=>$subject_id])->asArray()->all(),'id','name') as $key => $value){
                    ArrayHelper::setValue($out, $key, ['id' => $key,'name'=>$value]);
                }
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
    public function actionTown() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            if ($_POST['depdrop_parents'] != null) {
                $region_id = end($_POST['depdrop_parents']);
                foreach (ArrayHelper::map(Town::find()->where(['region_id'=>$region_id])->asArray()->all(),'id','name') as $key => $value){
                    ArrayHelper::setValue($out, $key, ['id' => $key,'name'=>$value]);
                }
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
    public function actionStreet() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            if ($_POST['depdrop_parents'] != null) {
                $town_id = end($_POST['depdrop_parents']);
                foreach (ArrayHelper::map(Street::find()->where(['town_id'=>$town_id])->asArray()->all(),'id','name') as $key => $value){
                    ArrayHelper::setValue($out, $key, ['id' => $key,'name'=>$value]);
                }
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    public function actionList()
    {
        $searchModel = new CustomerSearch();
        $customers = $searchModel->search(Yii::$app->request->post());
        return $this->render('list',compact('customers','searchModel'));
    }

}