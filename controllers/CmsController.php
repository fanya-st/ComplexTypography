<?php


namespace app\controllers;


use app\models\AuthItem;
use app\models\Rack;
use app\models\Region;
use app\models\RegionSearch;
use app\models\Shelf;
use app\models\Street;
use app\models\Warehouse;
use app\models\AuthItemSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\OrderSearch;
use app\models\Order;
use app\models\Sleeve;
use app\models\Town;
use app\models\TownSearch;
use app\models\StreetSearch;
use app\models\Subject;
use app\models\Customer;
use app\models\Label;
use app\models\LabelSearch;
use app\models\CustomerSearch;
use yii\data\ActiveDataProvider;
use app\models\CalcCommonParam;
use app\models\CalcMashineParamValue;
use app\models\CalcMashineParamValueSearch;
use app\models\RackSearch;
use app\models\ShelfSearch;
use app\models\AuthAssignment;
use app\models\AuthAssignmentSearch;
use yii;
use yii\web\NotFoundHttpException;

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
        $order->delete();
        return $this->redirect(['order-list']);
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
        $model = Customer::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['customer-index']);
        }

        return $this->render('customer\update', [
            'model' => $model,
        ]);
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


    /*Редактирование списка складов*/

    public function actionWarehouseIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Warehouse::find(),
        ]);

        return $this->render('warehouse\index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionWarehouseCreate()
    {
        $model = new Warehouse();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['warehouse-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('warehouse\create', [
            'model' => $model,
        ]);
    }

    public function actionWarehouseUpdate($id)
    {
        $model = Warehouse::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['warehouse-index']);
        }

        return $this->render('warehouse\update', [
            'model' => $model,
        ]);
    }



    /*Редактирование стелажей*/

    public function actionRackIndex()
    {
        $searchModel = new RackSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('rack\index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionRackCreate()
    {
        $model = new Rack();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['rack-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('rack\create', [
            'model' => $model,
        ]);
    }


    public function actionRackUpdate($id)
    {
        $model = Rack::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['rack-index']);
        }

        return $this->render('rack\update', [
            'model' => $model,
        ]);
    }


    /*Редактирование полок*/

    public function actionShelfIndex()
    {
        $searchModel = new ShelfSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('shelf\index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionShelfCreate()
    {
        $model = new Shelf();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['shelf-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('shelf\create', [
            'model' => $model,
        ]);
    }

    public function actionShelfUpdate($id)
    {
        $model = Shelf::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['shelf-index']);
        }

        return $this->render('shelf\update', [
            'model' => $model,
        ]);
    }



    /*Редактирование состав сотрудников в группах */

    public function actionAuthAssignIndex()
    {
        $searchModel = new AuthAssignmentSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('auth-assignment\index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAuthAssignCreate()
    {
        $model = new AuthAssignment();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['auth-assign-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('auth-assignment\create', [
            'model' => $model,
        ]);
    }

    public function actionAuthAssignUpdate($item_name, $user_id)
    {
        $model = $this->findModelAuthAssign($item_name, $user_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['auth-assign-index']);
        }

        return $this->render('auth-assignment\update', [
            'model' => $model,
        ]);
    }


    protected function findModelAuthAssign($item_name, $user_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /*Редактирование групп сотрудников*/

    public function actionAuthItemIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('auth-item\index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionAuthItemView($name)
    {
        return $this->render('auth-item\view', [
            'model' => $this->findModelAuthItem($name),
        ]);
    }


    public function actionAuthItemCreate()
    {
        $model = new AuthItem();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['auth-item-view', 'name' => $model->name]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('auth-item\create', [
            'model' => $model,
        ]);
    }

    public function actionAuthItemUpdate($name)
    {
        $model = $this->findModelAuthItem($name);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['auth-item-view', 'name' => $model->name]);
        }

        return $this->render('auth-item\update', [
            'model' => $model,
        ]);
    }

    protected function findModelAuthItem($name)
    {
        if (($model = AuthItem::findOne(['name' => $name])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }

}