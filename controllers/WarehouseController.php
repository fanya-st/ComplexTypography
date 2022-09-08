<?php


namespace app\controllers;


use app\models\Envelope;
use app\models\Shelf;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Warehouse;
use app\models\Rack;

class WarehouseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','rack-list','update','delete'],
                        'roles' => ['warehouse_manager'],
                    ],

                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $data = Warehouse::find()->all();

        return $this->render('index', compact('data'));
    }

    public function actionRackList($id)
    {
        $rack=Rack::findOne($id);

        $shelfs = Shelf::find()->where(['rack_id'=>$id])->all();

//        $envelope_items= Envelope::find()->where(['shelf_id'=>$shelfs])->all();

        return $this->render('_rack', compact('shelfs','rack'));
    }
}