<?php


namespace app\controllers;


use app\models\FinancialReport;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\FinancialReportSearch;

class FinancialReportController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['manager'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new FinancialReportSearch();
        $orders = $searchModel->search($this->request->post());
        return $this->render('index',compact('orders','searchModel'));
    }

}