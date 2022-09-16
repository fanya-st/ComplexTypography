<?php

namespace app\controllers;

use app\models\EnterpriseCost;
use app\models\EnterpriseCostSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii;


class EnterpriseCostController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','create','update','delete'],
                        'roles' => ['accountant'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['manager'],
                    ],

                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new EnterpriseCostSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate(): yii\web\Response|string
    {
        $model = new EnterpriseCost();

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

    public function actionUpdate(int $id): yii\web\Response|string
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete(int $id): yii\web\Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel(int $id): ?EnterpriseCost
    {
        if (($model = EnterpriseCost::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}
