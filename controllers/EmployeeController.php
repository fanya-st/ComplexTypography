<?php


namespace app\controllers;


use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\User;

class EmployeeController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list','qr-print','view'],
                        'roles' => ['@'],
                    ],

                ],
            ],
        ];
    }

    public function actionList(){
        $employees=User::getUserList();
        return $this->render('list',compact('employees'));
    }

    public function actionView($username){
        $employee=User::findByUsername($username);
        return $this->render('view',compact('employee'));
    }

    public function actionQrPrint($username){
        return $this->renderAjax('qr-code-print',compact('username'));
    }
}