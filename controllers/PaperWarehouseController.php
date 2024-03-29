<?php


namespace app\controllers;


use app\models\PaperWarehouse;
use app\models\PaperWarehouseRollCut;
use app\models\PaperWarehouseSearch;
use app\models\StockOnHandPaper;
use app\models\UploadPaper;
use app\models\UploadPaperForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii;

class PaperWarehouseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list','upload-paper','upload-paper-to-warehouse',
                            'barcode-print','roll-cut','move-roll'],
                        'roles' => ['warehouse_manager'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list', 'barcode-print','roll-cut'],
                        'roles' => ['printer'],
                    ],
                ],
            ],
        ];
    }

    public function actionList(): string
    {
        $searchModel = new PaperWarehouseSearch();
        $paper_warehouse = $searchModel->search($this->request->post());
        return $this->render('list',compact('paper_warehouse','searchModel'));
    }

    public function actionUploadPaper(): yii\web\Response|string
    {
        $upload_paper_form=new UploadPaperForm();
        if ($upload_paper_form->load(Yii::$app->request->post())) {
            $upload_paper_form->csv=UploadedFile::getInstance($upload_paper_form, 'csv');
            if ($upload_paper_form->upload()) {
                Yii::$app->session->setFlash('success', 'Данные загружены');
                return $this->refresh();
            }
        }
        return $this->render('upload_paper_from_provider',compact('upload_paper_form'));
    }

    public function actionBarcodePrint(int $id): string
    {
        $paper_warehouse=PaperWarehouse::findOne($id);
        return $this->renderAjax('barcode_print',compact('paper_warehouse'));
    }

    public function actionRollCut(): string
    {
        $paper_warehouse=new PaperWarehouseRollCut();
        if ($this->request->isPost) {
        if ($paper_warehouse->load($this->request->post())) {
            if ($paper_warehouse->rollcut()){
                $rollone=PaperWarehouse::findOne($paper_warehouse->id1);
                $rolltwo=PaperWarehouse::findOne($paper_warehouse->id2);
            }
            return $this->render('roll-cut',compact('paper_warehouse', 'rollone', 'rolltwo'));
        }
        }
        return $this->render('roll-cut',compact('paper_warehouse'));
    }

    public function actionUploadPaperToWarehouse(): yii\web\Response|string
    {
        $upload_paper_list = null;
        $paper = new ActiveDataProvider([
            'query' => UploadPaper::find()
        ]);
        $upload_paper_form=new UploadPaperForm();
        if ($upload_paper_form->load(Yii::$app->request->post())) {
            $upload_paper_list=UploadPaper::find()->orFilterWhere(['roll_id'=>$upload_paper_form->barcode])
                ->orFilterWhere(['pallet_id'=>$upload_paper_form->barcode])->all();
            foreach ($upload_paper_list as $temp){
                if (isset($temp->material->id)){
                    $paper_warehouse=new PaperWarehouse();
                    $paper_warehouse->material_id=$temp->material->id;
                    $paper_warehouse->length=$temp->length;
                    $paper_warehouse->width=$temp->width;
                    $paper_warehouse->save();
                    $temp->delete();
                }
            }
            return $this->refresh();
        }
        return $this->render('upload_paper_to_warehouse',compact('paper','upload_paper_form','upload_paper_list'));
    }

    public function actionMoveRoll(): yii\web\Response|string
    {
        $roll=new PaperWarehouse();
        if ($this->request->isPost && $roll->load($this->request->post()) && $roll->validate($this->request->post())) {
                if(!empty($roll->shelf_id)){
                    $moved_roll=PaperWarehouse::findOne($roll->id);
                    $moved_roll->shelf_id=$roll->shelf_id;
                    $moved_roll->save();
                    Yii::$app->session->setFlash('success', 'Ролик перемещен');
                    return $this->refresh();
                }
        }

        return $this->render('move-roll',compact('roll'));
    }



}