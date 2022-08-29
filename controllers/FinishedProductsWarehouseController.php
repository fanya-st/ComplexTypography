<?php


namespace app\controllers;

use app\models\FinishedProductsWarehouseSearch;
use yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class FinishedProductsWarehouseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['surplus-list'],
                        'roles' => ['manager','logistician'],
                    ],

                ],
            ],
        ];
    }

    public function actionSurplusList()
    {
        $searchModel = new FinishedProductsWarehouseSearch();
        $surplus = $searchModel->search(Yii::$app->request->post());
        return $this->render('surplus-list',compact('surplus','searchModel'));
    }

}