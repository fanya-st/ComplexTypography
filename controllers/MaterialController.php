<?php


namespace app\controllers;


use app\models\Material;
use app\models\OrderMaterial;
use app\models\PaperWarehouse;
use app\models\StockOnHandPaperSearch;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use app\models\StockOnHandPaper;
use yii\db\Expression;
use app\models\MaterialForm;
use yii\filters\AccessControl;
use app\models\Order;
use yii\helpers\ArrayHelper;
use app\models\MaterialMovement;
use yii\web\Controller;
use yii;
use app\models\MaterialSearch;

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
                    [
                        'allow' => true,
                        'actions' => ['list','view','update','create','stock-on-hand-paper','material-movement','inactive','active'],
                        'roles' => ['warehouse_manager'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view','stock-on-hand-paper'],
                        'roles' => ['printer'],
                    ],

                ],
            ],
        ];
    }
    public function actionPaperConsumption(int $id): yii\web\Response|string
    {
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

    public function actionList(): string
    {
        $searchModel = new MaterialSearch();
        $material = $searchModel->search(Yii::$app->request->post());
            return $this->render('list',compact('material','searchModel'));
    }

    public function actionView(int $id): string
    {
        $material=Material::findOne($id);
        $material_warehouse=PaperWarehouse::find()->select(['material_id','width',new Expression('SUM(length) as length')])->where(['>','length',0])->andWhere(['material_id'=>$id])->groupBy(['width','material_id'])->all();
        return $this->render('view',compact('material','material_warehouse'));
    }

    public function actionUpdate(int $id): yii\web\Response|string
    {
        $material=MaterialForm::findOne($id);
        if($material->load(Yii::$app->request->post()) && $material->validate(Yii::$app->request->post())){
            if ($material->save()){
//                Yii::info("Создана этикетка пользователем ".Yii::$app->user->identity->username.' №'.$model->id);
//                Yii::$app->session->setFlash('success','Материал обновлен');
                return $this->redirect(['material/view','id'=>$material->id]);
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
        }
        return $this->render('update',compact('material'));
    }

    public function actionInactive(int $id): yii\web\Response
    {
        $material=Material::findOne($id);
        $material->status=0;
        $material->save();
        return $this->redirect(['material/list']);
    }

    public function actionActive(int $id): yii\web\Response
    {
        $material=Material::findOne($id);
        $material->status=1;
        $material->save();
        return $this->redirect(['material/list']);
    }

    public function actionCreate(): yii\web\Response|string
    {
        $material=new MaterialForm;
        if($material->load(Yii::$app->request->post()) && $material->validate(Yii::$app->request->post())){
            if ($material->save()){
                return $this->redirect(['material/view','id'=>$material->id]);
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
        }
        return $this->render('update',compact('material'));
    }

    public function actionStockOnHandPaper(): string
    {
        $searchModel = new StockOnHandPaper();
        $items = $searchModel->search(Yii::$app->request->post());
        return $this->render('stock-on-hand-paper',compact('items','searchModel'));
    }

    public function actionMaterialMovement(): string
    {
        $searchModel = new MaterialMovement();
        $items = $searchModel->search(Yii::$app->request->post());
        return $this->render('material-movement',compact('items','searchModel'));
    }
}