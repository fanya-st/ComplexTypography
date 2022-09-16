<?php

namespace app\controllers;

use app\models\MixedPantone;
use app\models\Pantone;
use app\models\PantoneSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii;


class PantoneController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['delete','create','update','index','view'],
                        'roles' => ['warehouse_manager'],
                    ],

                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new PantoneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id): string
    {
        $model=$this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate(): yii\web\Response|string
    {
        $model = new Pantone();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate($this->request->post()) ) {
                if( $model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
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
        if($model->pantone_kind_id==2){
            $mixed_pantones=MixedPantone::find()->where(['pantone_id'=>$model->id])->all();
        }

        if ($this->request->isPost) {
            if ($this->request->post('update_pantone_param')=='' && $model->load($this->request->post()) && $model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            if ($this->request->post('update_mixed_param')=='' && MixedPantone::loadMultiple($mixed_pantones, $this->request->post()) && MixedPantone::validateMultiple($mixed_pantones)) {
                foreach ($mixed_pantones as $mixed_pantone) {
                    $mixed_pantone->save();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'mixed_pantones' => $mixed_pantones,
        ]);
    }

    public function actionDelete(int $id): yii\web\Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel(int $id): ?Pantone
    {
        if (($model = Pantone::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
