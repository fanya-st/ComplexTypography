<?php


namespace app\controllers;


use app\models\Region;
use app\models\RegionSearch;
use app\models\Street;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\OrderSearch;
use app\models\Order;
use app\models\Sleeve;
use app\models\Town;
use app\models\TownSearch;
use app\models\StreetSearch;
use app\models\Subject;
use app\models\CustomerForm;
use app\models\Label;
use app\models\LabelSearch;
use app\models\CustomerSearch;
use yii\data\ActiveDataProvider;
use app\models\CalcCommonParam;
use app\models\CalcMashineParamValue;
use app\models\CalcMashineParamValueSearch;
use yii;

class CmsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['cms-panel','order-list','order-view','order-update','order-delete',
                            'sleeve-index','sleeve-update','sleeve-create',
                            'subject-index','subject-update','subject-create',
                            'region-index','region-update','region-create',
                            'town-index','town-update','town-create',
                            'street-index','street-update','street-create',
                            'calc-mashine-param-price-view','calc-mashine-param-price-update','calc-mashine-param-price-create','calc-mashine-param-price-index',
                            'calc-common-params-index','calc-common-params-update','calc-common-params-create',
                            'customer-index','customer-update',
                            'label-index','label-update',
                            ],
                        'roles' => ['admin'],
                    ],

                ],
            ],
        ];
    }

    public function actionCmsPanel()
    {
        return $this->render('cms-panel');
    }

    public function actionOrderList()
    {
        $searchModel = new OrderSearch();
        $orders = $searchModel->search(Yii::$app->request->post());
        return $this->render('order\list',compact('orders','searchModel'));
    }

    public function actionOrderView($id)
    {
        $order = Order::findOne($id);
        return $this->render('order\view',compact('order'));
    }

    public function actionOrderUpdate($id)
    {
        $order = Order::findOne($id);
        if($order->load(Yii::$app->request->post()) && $order->validate(Yii::$app->request->post())){
            if($order->save()) return $this->refresh();
        }
        return $this->render('order\update',compact('order'));
    }

    public function actionOrderDelete($id)
    {
        $order = Order::findOne($id);
        if(!empty($order->orderMaterialList)){
            Yii::$app->session->setFlash('error','Заказ не может быть удален, на нем есть расход материала');
            return $this->redirect(['cms/order-view','id'=>$order->id]);
        }elseif(!empty($order->shipmentOrder)){
            Yii::$app->session->setFlash('error','Заказ не может быть удален, он находиться в отправке');
            return $this->redirect(['cms/order-view','id'=>$order->id]);
        }else{
            $order->delete();
            Yii::info("Заказ №".$id." удален пользователем ".Yii::$app->user->identity->username);
            return $this->runAction('order-list');
        }
    }

    /*Редактирование списка втулок*/

    public function actionSleeveIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sleeve::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('sleeve\index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionSleeveCreate()
    {
        $model = new Sleeve();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['sleeve-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('sleeve\create', [
            'model' => $model,
        ]);
    }

    public function actionSleeveUpdate($id)
    {
        $model = Sleeve::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['sleeve-index']);
        }

        return $this->render('sleeve\update', [
            'model' => $model,
        ]);
    }
    public function actionSleeveDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['sleeve-index']);
    }

    /*Редактировние списка субъектов РФ*/

    public function actionSubjectIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Subject::find(),
        ]);

        return $this->render('subject\index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubjectCreate()
    {
        $model = new Subject();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['subject-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('subject\create', [
            'model' => $model,
        ]);
    }

    public function actionSubjectUpdate($id)
    {
        $model = Subject::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['subject-index']);
        }

        return $this->render('subject\update', [
            'model' => $model,
        ]);
    }

    public function actionSubjectDelete($id)
    {
        Subject::findOne($id)->delete();

        return $this->redirect(['subject-index']);
    }

    /*Редактирование списка регионов*/

    public function actionRegionIndex()
    {
        $searchModel = new RegionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('region\index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRegionCreate()
    {
        $model = new Region();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['region-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('region\create', [
            'model' => $model,
        ]);
    }

    public function actionRegionUpdate($id)
    {
        $model = Region::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['region-index']);
        }

        return $this->render('region\update', [
            'model' => $model,
        ]);
    }

    public function actionRegionDelete($id)
    {
        Region::findOne($id)->delete();

        return $this->redirect(['region-index']);
    }

    /*Редактирование адм.центров*/

    public function actionTownIndex()
    {
        $searchModel = new TownSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('town\index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionTownCreate()
    {
        $model = new Town();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['town-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('town\create', [
            'model' => $model,
        ]);
    }


    public function actionTownUpdate($id)
    {
        $model = Town::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['town-index']);
        }

        return $this->render('town\update', [
            'model' => $model,
        ]);
    }

    public function actionTownDelete($id)
    {
        Town::findOne($id)->delete();

        return $this->redirect(['town-index']);
    }

    /*Редактирование списка улиц*/

    public function actionStreetIndex()
    {
        $searchModel = new StreetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('street\index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStreetCreate()
    {
        $model = new Street();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['street-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('street\create', [
            'model' => $model,
        ]);
    }

    public function actionStreetUpdate($id)
    {
        $model = Street::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['street-index']);
        }

        return $this->render('street\update', [
            'model' => $model,
        ]);
    }

    public function actionStreetDelete($id)
    {
        Street::findOne($id)->delete();

        return $this->redirect(['street-index']);
    }

    /*Редактирование заказчиков*/

    public function actionCustomerIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('customer\index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCustomerUpdate($id)
    {
        $model = CustomerForm::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['customer-index']);
        }

        return $this->render('customer\update', [
            'model' => $model,
        ]);
    }

    public function actionCustomerDelete($id)
    {
        CustomerForm::findOne($id)->delete();

        return $this->redirect(['customer-index']);
    }

    /*Редактирование этикеток*/

    public function actionLabelIndex()
    {
        $searchModel = new LabelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('label\index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLabelUpdate($id)
    {
        $model=Label::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['label-index']);
        }

        return $this->render('label\update', [
            'model' => $model,
        ]);
    }

    public function actionLabelDelete($id)
    {
        Label::findOne($id)->delete();

        return $this->redirect(['label-index']);
    }

    /*Редактирование общих параметров для калькулятора*/

    public function actionCalcCommonParamsIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CalcCommonParam::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('calc-common-params\index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCalcCommonParamsCreate()
    {
        $model = new CalcCommonParam();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
                $model->date=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                if($model->save()){
                    return $this->redirect(['calc-common-params-index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('calc-common-params\create', [
            'model' => $model,
        ]);
    }

    public function actionCalcCommonParamsUpdate($id)
    {
        $model = CalcCommonParam::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->date=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');;
            if($model->save()){
                return $this->redirect(['calc-common-params-index']);
            }
        }

        return $this->render('calc-common-params\update', [
            'model' => $model,
        ]);
    }

    public function actionCalcCommonParamsDelete($id)
    {
        CalcCommonParam::findOne($id)->delete();

        return $this->redirect(['calc-common-params-index']);
    }

    /*Редактирование параметров машин*/

    public function actionCalcMashineParamPriceIndex()
    {
        $searchModel = new CalcMashineParamValueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('calc-mashine-param-price\index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCalcMashineParamPriceView($id)
    {
        return $this->render('calc-mashine-param-price\view', [
            'model' => CalcMashineParamValue::findOne($id),
        ]);
    }

    public function actionCalcMashineParamPriceCreate()
    {
        $model = new CalcMashineParamValue();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['calc-mashine-param-price-view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('calc-mashine-param-price\create', [
            'model' => $model,
        ]);
    }


    public function actionCalcMashineParamPriceUpdate($id)
    {
        $model = CalcMashineParamValue::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['calc-mashine-param-price-view', 'id' => $model->id]);
        }

        return $this->render('calc-mashine-param-price\update', [
            'model' => $model,
        ]);
    }

    public function actionCalcMashineParamPriceDelete($id)
    {
        CalcMashineParamValue::findOne($id)->delete();

        return $this->redirect(['calc-mashine-param-price-index']);
    }


}