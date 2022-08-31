<?php

namespace app\controllers;

use app\models\PantoneWarehouse;
use app\models\PantoneWarehouseSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii;


class PantoneWarehouseController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','update','barcode-print','create','move-pantone'],
                        'roles' => ['warehouse_manager'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','barcode-print'],
                        'roles' => ['printer'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $searchModel = new PantoneWarehouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionCreate()
    {
        $model = new PantoneWarehouse();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = PantoneWarehouse::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBarcodePrint($id){
        $pantone_warehouse=$this->findModel($id);
        return $this->renderAjax('barcode_print',compact('pantone_warehouse'));
    }

    public function actionMovePantone(){
        $pantone=new PantoneWarehouse();
        if ($this->request->isPost && $pantone->load($this->request->post()) && $pantone->validate($this->request->post())) {
            if(!empty($pantone->shelf_id)){
                $moved_pantone=PantoneWarehouse::findOne($pantone->id);
                $moved_pantone->shelf_id=$pantone->shelf_id;
                $moved_pantone->save();
                Yii::$app->session->setFlash('success', 'PANTONE перемещен');
                return $this->refresh();
            }
        }

        return $this->render('move-pantone',compact('pantone'));
    }
}
