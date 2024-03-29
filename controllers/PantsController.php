<?php

namespace app\controllers;

use app\models\Pants;
use app\models\PantsPictureForm;
use app\models\PantsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii;
use yii\web\UploadedFile;


class PantsController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list','view','update','create','index'],
                        'roles' => ['manager'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view','index'],
                        'roles' => ['printer'],
                    ],

                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['manager_admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view','index'],
                        'roles' => ['warehouse_manager'],
                    ],

                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new PantsSearch();
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

    public function actionCreate(): yii\web\Response|string
    {
        $model = new Pants();
        $picture_form=new PantsPictureForm;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $picture_form->load(Yii::$app->request->post())) {
                $picture_form->picture=UploadedFile::getInstance($picture_form, 'picture');
                if ($picture_form->upload($model)){
                    if($model->save())
                        return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'picture_form'=>$picture_form,
        ]);
    }

    public function actionUpdate(int $id): yii\web\Response|string
    {
        $model = $this->findModel($id);
        $picture_form=new PantsPictureForm;

        if ($this->request->isPost && $model->load($this->request->post())) {
            if($picture_form->load(Yii::$app->request->post())){
                $picture_form->picture=UploadedFile::getInstance($picture_form, 'picture');
                $picture_form->upload($model);
            }
            if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'picture_form'=>$picture_form,
        ]);
    }

    public function actionDelete(int $id): yii\web\Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id)
    {
        if (($model = Pants::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
