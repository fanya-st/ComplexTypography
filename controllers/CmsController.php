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
    public function behaviors(): array
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

    public function actionCmsPanel(): string
    {
        return $this->render('cms-panel');
    }

    public function actionOrderList(): string
    {
        $searchModel = new OrderSearch();
        $orders = $searchModel->search(Yii::$app->request->post());
        return $this->render('order/list',compact('orders','searchModel'));
    }

    public function actionOrderView(int $id): string
    {
        $order = Order::findOne($id);
        return $this->render('order/view',compact('order'));
    }

    public function actionOrderUpdate(int $id): yii\web\Response|string
    {
        $order = Order::findOne($id);
        if($order->load(Yii::$app->request->post()) && $order->validate(Yii::$app->request->post())){
            if($order->save()) return $this->refresh();
        }
        return $this->render('order/update',compact('order'));
    }

    /**
     * @throws \Throwable
     * @throws yii\db\StaleObjectException
     */
    public function actionOrderDelete($id)
    {
        $order = Order::findOne($id);
        $order->delete();
        return $this->redirect(['order-list']);
    }

    /*Редактирование списка втулок*/

    public function actionSleeveIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sleeve::find(),
        ]);

        return $this->render('sleeve/index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionSleeveCreate(): yii\web\Response|string
    {
        $model = new Sleeve();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['sleeve-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('sleeve/create', [
            'model' => $model,
        ]);
    }

    public function actionSleeveUpdate(int $id): yii\web\Response|string
    {
        $model = Sleeve::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['sleeve-index']);
        }

        return $this->render('sleeve/update', [
            'model' => $model,
        ]);
    }

    /*Редактировние списка субъектов РФ*/

    public function actionSubjectIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Subject::find(),
        ]);

        return $this->render('subject/index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubjectCreate(): yii\web\Response|string
    {
        $model = new Subject();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['subject-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('subject/create', [
            'model' => $model,
        ]);
    }

    public function actionSubjectUpdate(int $id): yii\web\Response|string
    {
        $model = Subject::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['subject-index']);
        }

        return $this->render('subject/update', [
            'model' => $model,
        ]);
    }

    /*Редактирование списка регионов*/

    public function actionRegionIndex(): string
    {
        $searchModel = new RegionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('region/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRegionCreate(): yii\web\Response|string
    {
        $model = new Region();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['region-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('region/create', [
            'model' => $model,
        ]);
    }

    public function actionRegionUpdate(int $id): yii\web\Response|string
    {
        $model = Region::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['region-index']);
        }

        return $this->render('region/update', [
            'model' => $model,
        ]);
    }


    /*Редактирование адм.центров*/

    public function actionTownIndex(): string
    {
        $searchModel = new TownSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('town/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionTownCreate(): yii\web\Response|string
    {
        $model = new Town();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['town-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('town/create', [
            'model' => $model,
        ]);
    }


    public function actionTownUpdate(int $id): yii\web\Response|string
    {
        $model = Town::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['town-index']);
        }

        return $this->render('town/update', [
            'model' => $model,
        ]);
    }


    /*Редактирование списка улиц*/

    public function actionStreetIndex(): string
    {
        $searchModel = new StreetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('street/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStreetCreate(): yii\web\Response|string
    {
        $model = new Street();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['street-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('street/create', [
            'model' => $model,
        ]);
    }

    public function actionStreetUpdate(int $id): yii\web\Response|string
    {
        $model = Street::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['street-index']);
        }

        return $this->render('street/update', [
            'model' => $model,
        ]);
    }

    /*Редактирование заказчиков*/

    public function actionCustomerIndex(): string
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('customer/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCustomerUpdate(int $id): yii\web\Response|string
    {
        $model = Customer::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['customer-index']);
        }

        return $this->render('customer/update', [
            'model' => $model,
        ]);
    }

    /*Редактирование этикеток*/

    public function actionLabelIndex(): string
    {
        $searchModel = new LabelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('label/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLabelUpdate(int $id): yii\web\Response|string
    {
        $model=Label::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['label-index']);
        }

        return $this->render('label/update', [
            'model' => $model,
        ]);
    }


    /*Редактирование общих параметров для калькулятора*/

    public function actionCalcCommonParamsIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CalcCommonParam::find(),
        ]);

        return $this->render('calc-common-params/index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCalcCommonParamsCreate(): yii\web\Response|string
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

        return $this->render('calc-common-params/create', [
            'model' => $model,
        ]);
    }

    public function actionCalcCommonParamsUpdate(int $id): yii\web\Response|string
    {
        $model = CalcCommonParam::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->date=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');;
            if($model->save()){
                return $this->redirect(['calc-common-params-index']);
            }
        }

        return $this->render('calc-common-params/update', [
            'model' => $model,
        ]);
    }


    /*Редактирование параметров машин*/

    public function actionCalcMashineParamPriceIndex(): string
    {
        $searchModel = new CalcMashineParamValueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('calc-mashine-param-price/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCalcMashineParamPriceView(int $id): string
    {
        return $this->render('calc-mashine-param-price/view', [
            'model' => CalcMashineParamValue::findOne($id),
        ]);
    }

    public function actionCalcMashineParamPriceCreate(): yii\web\Response|string
    {
        $model = new CalcMashineParamValue();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['calc-mashine-param-price-view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('calc-mashine-param-price/create', [
            'model' => $model,
        ]);
    }


    public function actionCalcMashineParamPriceUpdate(int $id): yii\web\Response|string
    {
        $model = CalcMashineParamValue::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['calc-mashine-param-price-view', 'id' => $model->id]);
        }

        return $this->render('calc-mashine-param-price/update', [
            'model' => $model,
        ]);
    }


    /*Редактирование списка складов*/

    public function actionWarehouseIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Warehouse::find(),
        ]);

        return $this->render('warehouse/index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionWarehouseCreate(): yii\web\Response|string
    {
        $model = new Warehouse();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['warehouse-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('warehouse/create', [
            'model' => $model,
        ]);
    }

    public function actionWarehouseUpdate(int $id): yii\web\Response|string
    {
        $model = Warehouse::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['warehouse-index']);
        }

        return $this->render('warehouse/update', [
            'model' => $model,
        ]);
    }



    /*Редактирование стелажей*/

    public function actionRackIndex(): string
    {
        $searchModel = new RackSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('rack/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionRackCreate(): yii\web\Response|string
    {
        $model = new Rack();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['rack-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('rack/create', [
            'model' => $model,
        ]);
    }


    public function actionRackUpdate(int $id): yii\web\Response|string
    {
        $model = Rack::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['rack-index']);
        }

        return $this->render('rack/update', [
            'model' => $model,
        ]);
    }


    /*Редактирование полок*/

    public function actionShelfIndex(): string
    {
        $searchModel = new ShelfSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('shelf/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionShelfCreate(): yii\web\Response|string
    {
        $model = new Shelf();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['shelf-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('shelf/create', [
            'model' => $model,
        ]);
    }

    public function actionShelfUpdate(int $id): yii\web\Response|string
    {
        $model = Shelf::findOne($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['shelf-index']);
        }

        return $this->render('shelf/update', [
            'model' => $model,
        ]);
    }



    /*Редактирование состав сотрудников в группах */

    public function actionAuthAssignIndex(): string
    {
        $searchModel = new AuthAssignmentSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('auth-assignment/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAuthAssignCreate(): yii\web\Response|string
    {
        $model = new AuthAssignment();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['auth-assign-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('auth-assignment/create', [
            'model' => $model,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionAuthAssignUpdate(string $item_name, int $user_id): yii\web\Response|string
    {
        $model = $this->findModelAuthAssign($item_name, $user_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['auth-assign-index']);
        }

        return $this->render('auth-assignment/update', [
            'model' => $model,
        ]);
    }


    /**
     * @throws NotFoundHttpException
     */
    protected function findModelAuthAssign(string $item_name, int $user_id): ?AuthAssignment
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /*Редактирование групп сотрудников*/

    public function actionAuthItemIndex(): string
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('auth-item/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionAuthItemView(string $name): string
    {
        return $this->render('auth-item/view', [
            'model' => $this->findModelAuthItem($name),
        ]);
    }


    public function actionAuthItemCreate(): yii\web\Response|string
    {
        $model = new AuthItem();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['auth-item-view', 'name' => $model->name]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('auth-item/create', [
            'model' => $model,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionAuthItemUpdate(string $name): yii\web\Response|string
    {
        $model = $this->findModelAuthItem($name);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['auth-item-view', 'name' => $model->name]);
        }

        return $this->render('auth-item/update', [
            'model' => $model,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findModelAuthItem(string $name): ?AuthItem
    {
        if (($model = AuthItem::findOne(['name' => $name])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }

}