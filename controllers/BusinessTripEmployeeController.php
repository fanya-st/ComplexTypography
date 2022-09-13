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

    public function behaviors(): array
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


    public function actionIndex(): string
    {
        $searchModel = new BusinessTripEmployeeSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCalendar(): string
    {
        $searchModel = new BusinessTripEmployeeSearch();
        $dataProvider = $searchModel->search($this->request->post());
        $data=$dataProvider ->getModels();
        return $this->render('calendar',compact('data','searchModel'));
    }


    public function actionCreate(): yii\web\Response|string
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


    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id): yii\web\Response|string
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @throws yii\db\StaleObjectException
     * @throws \Throwable
     * @throws NotFoundHttpException
     */
    public function actionDelete(int $id): yii\web\Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findModel($id): ?BusinessTripEmployee
    {
        if (($model = BusinessTripEmployee::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая командировка не найдена.');
    }
}
