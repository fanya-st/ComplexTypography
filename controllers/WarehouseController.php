<?php


namespace app\controllers;


use app\models\Shelf;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Warehouse;
use app\models\Rack;

class WarehouseController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','rack-list','shelf-list','qr-print-rack','qr-print-shelf'],
                        'roles' => ['warehouse_manager'],
                    ],

                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $data = Warehouse::find()->all();

        return $this->render('index', compact('data'));
    }

    public function actionRackList(int $id): string
    {
        $rack=Rack::findOne($id);

        $shelfs = Shelf::find()->where(['rack_id'=>$id])->all();

        return $this->render('_rack', compact('shelfs','rack'));
    }

    public function actionShelfList(int $id): string
    {
        $shelf=Shelf::findOne($id);

        $rack=Rack::findOne($shelf->rack->id);

        return $this->render('_shelf', compact('shelf','rack'));
    }

    public function actionQrPrintRack(int $id): string
    {
        $rack=Rack::findOne($id);
        return $this->renderAjax('qr-rack', compact('rack'));
    }

    public function actionQrPrintShelf(int $id): string
    {
        $shelf=Shelf::findOne($id);
        return $this->renderAjax('qr-shelf', compact('shelf'));
    }
}