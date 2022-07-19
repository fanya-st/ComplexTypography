<?php


namespace app\controllers;


use app\models\PaperWarehouseSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii;

class PaperWarehouseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list'],
                        'roles' => ['warehouse_manager'],
                    ],
                ],
            ],
        ];
    }

    public function actionList(){
        $searchModel = new PaperWarehouseSearch();
        $paper_warehouse = $searchModel->search(Yii::$app->request->post());
        return $this->render('list',compact('paper_warehouse','searchModel'));
    }

}