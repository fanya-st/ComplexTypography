<?php


namespace app\controllers;


use app\models\Pants;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Calculator;
use yii\web\Response;
use yii\helpers\Json;
use yii;

class CalculatorController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['calculator','get-pants-param'],
                        'roles' => ['manager'],
                    ],
                ],
            ],
        ];
    }

    public function actionCalculator()
    {
        $calculator = new Calculator();
//        $pants = Pants::findOne($pants_id);
        $pants = new Pants();
        if ($this->request->isPost) {
            if ($calculator->load($this->request->post()) && $calculator->validate() && $pants->load($this->request->post())) {
                    $calculator->calculate($pants);
//                Yii::$app->session->setFlash('success','Успех');
            }
        }
        return $this->render('calculator',compact('calculator','pants'));
    }

    public function actionGetPantsParam($pants_id)
    {
        if ($this->request->isAjax) {
            $pants=Pants::findOne($pants_id);
//
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'status' => 'success',
                'message' => $pants,
            ];
        }

    }

}