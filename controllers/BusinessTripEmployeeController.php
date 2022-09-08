<?php

namespace app\controllers;

use app\models\BusinessTripEmployee;
use app\models\BusinessTripEmployeeSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii;


class BusinessTripEmployeeController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','create','update','view','calendar'],
                        'roles' => ['manager'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['admin'],
                    ],

                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $searchModel = new BusinessTripEmployeeSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCalendar()
    {
        $searchModel = new BusinessTripEmployeeSearch();
        $dataProvider = $searchModel->search($this->request->post());
        $data=$dataProvider ->getModels();
        return $this->render('calendar',compact('data','searchModel'));
    }


    public function actionCreate()
    {
        $model = new BusinessTripEmployee();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->user_id=Yii::$app->user->identity->getId();
                if($model->validate() && $model->save())
                return $this->redirect(['view', 'id' => $model->id]);
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
            return $this->redirect(['view', 'id' => $model->id]);
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
        if (($model = BusinessTripEmployee::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
