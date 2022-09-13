<?php

namespace app\controllers;

use app\models\BankTransfer;
use app\models\BankTransferSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class BankTransferController extends Controller
{

    public function behaviors(): array
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
        $searchModel = new BankTransferSearch();
        $dataProvider = $searchModel->search($this->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate(): \yii\web\Response|string
    {
        $model = new BankTransfer();

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


    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id): \yii\web\Response|string
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws NotFoundHttpException
     */
    public function actionDelete(int $id): \yii\web\Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id): ?BankTransfer
    {
        if (($model = BankTransfer::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая запись не найдена.');
    }
}
