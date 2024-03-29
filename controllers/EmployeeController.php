<?php


namespace app\controllers;


use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\UserSearch;
use app\models\User;

class EmployeeController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['qr-print','view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create','list','update','fire'],
                        'roles' => ['admin'],
                    ],

                ],
            ],
        ];
    }

    public function actionList(): string
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->post());
        return $this->render('list',compact('dataProvider','searchModel'));
    }

    public function actionView(int $id): string
    {
        $employee=User::findOne($id);
        return $this->render('view',compact('employee'));
    }

    public function actionQrPrint(int $id): string
    {
        return $this->renderAjax('qr-code-print',compact('id'));
    }

    public function actionCreate(): \yii\web\Response|string
    {
        $user=new User();
        if ($this->request->isPost && $user->load($this->request->post())) {
            if($user->save()){
                return $this->refresh();
            }

        }
        return $this->render('create',compact('user'));
    }

    public function actionUpdate(int $id): \yii\web\Response|string
    {
        $user=User::findOne($id);
        $user->password=null;
        if ($this->request->isPost && $user->load($this->request->post())) {
            if($user->validate() && $user->save()){
                return $this->refresh();
            }

        }
        return $this->render('update',compact('user'));
    }

    public function actionFire(int $id): \yii\web\Response
    {
        $user=User::findOne($id);
        $user->status_id=1;
        $user->save();
        return $this->redirect(['list']);
    }
}