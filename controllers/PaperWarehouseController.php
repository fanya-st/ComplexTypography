<?php


namespace app\controllers;


use app\models\PaperWarehouse;
use app\models\PaperWarehouseSearch;
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
                        'actions' => ['list','upload-paper','upload-paper-to-warehouse'],
                        'roles' => ['warehouse_manager'],
                    ],
                ],
            ],
        ];
    }

    public function actionList(){
        $searchModel = new PaperWarehouseSearch();
        $paper_warehouse = $searchModel->search(Yii::$app->request->post());
        return $this->render('list',compact('paper_warehouse','searchModel'));
    }

    public function actionUploadPaper(){
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

    public function actionUploadPaperToWarehouse(){
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

}