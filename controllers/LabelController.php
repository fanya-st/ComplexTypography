<?php


namespace app\controllers;

use app\models\CustomNav;
use app\models\LabelForm;
use app\models\PhotoOutput;
use Yii;
use app\models\Label;
use app\models\LabelSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class LabelController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list','create','view'],
                        'roles' => ['manager'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update','create-design-ready','approve-design'],
                        'roles' => ['updateOwnLabel','designer_admin','manager_admin'],
                        'roleParams' => function() {
                            return ['label' => Label::findOne(['id' => Yii::$app->request->get('id')])];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view','create-design'],
                        'roles' => ['designer'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view','create-prepress','create-prepress-ready'],
                        'roles' => ['prepress'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['subdpi'],
                        'roles' => ['@'],
                    ],

                ],
            ],
        ];
    }
    public function actionList()
    {
//        $this->layout = 'main_label_list';
        $searchModel = new LabelSearch();
        $labels = $searchModel->search(Yii::$app->request->post());
        return $this->render('list',compact('labels','searchModel'));
    }
    public function actionView($id)
    {
        $label=Label::findOne($id);
        switch (Yii::$app->user->identity->group) {
            case 'designer':
                $nav_items=CustomNav::getItemByStatusDesigner($label->status_id,$label->id);
            case 'designer_admin':
                $nav_items=ArrayHelper::merge(
                    CustomNav::getItemByStatusDesigner($label->status_id,$label->id),
                    CustomNav::getItemByStatusPrepress($label->status_id,$label->id)
                );
                break;
            case 'manager':
                $nav_items=CustomNav::getItemByStatusManager($label->status_id,$label->id);
            case 'manager_admin':
                $nav_items=CustomNav::getItemByStatusManager($label->status_id,$label->id);
                break;
            case 'prepress':
                $nav_items=CustomNav::getItemByStatusPrepress($label->status_id,$label->id);
                break;
            case 'admin':
                $nav_items=ArrayHelper::merge(
                    CustomNav::getItemByStatusDesigner($label->status_id,$label->id),
                    CustomNav::getItemByStatusManager($label->status_id,$label->id),
                    CustomNav::getItemByStatusPrepress($label->status_id,$label->id)
                );
                break;
        }
        return $this->render('view',compact('label','nav_items'));
    }
    public function actionUpdate($id)
    {
        $label=Label::findOne($id);
        if($label->load(Yii::$app->request->post())){
            if ($label->save()){
                Yii::$app->session->setFlash('success','Этикетка обновлена');
                return $this->redirect(['label/view','id'=>$id]);
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
        }
        return $this->render('update',compact('label'));
    }
    public function actionCreate()
    {
            $model=new LabelForm();
            if($model->load(Yii::$app->request->post())){
                if ($model->save()){
                    Yii::$app->session->setFlash('success','Этикетка создана');
                    return $this->redirect(['label/view','id'=>$model->id]);
                }else{
                    Yii::$app->session->setFlash('error','Ошибка');
                }
            }
            return $this->render('create', compact('model'));

    }
    public function actionCreateDesign($id)
    {
        $label=Label::findOne($id);
        $label->status_id=2;
        $label->designer_login=Yii::$app->user->identity->username;
            if ($label->save()){
                Yii::$app->session->setFlash('success','Дизайн создан');
                return $this->redirect(['label/view','id'=>$id]);
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
    }
    public function actionCreatePrepress($id)
    {
        $label=Label::findOne($id);
        $label->status_id=6;
        $label->prepress_login=Yii::$app->user->identity->username;
            if ($label->save()){
                Yii::$app->session->setFlash('success','Этикетка взята в Prepress');
                return $this->redirect(['label/view','id'=>$id]);
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
    }
    public function actionApproveDesign($id)
    {
        $label=Label::findOne($id);
        $label->status_id=4;
            if ($label->save()){
                Yii::$app->session->setFlash('success','Дизайн утвержден');
                return $this->redirect(['label/view','id'=>$id]);
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
    }
    public function actionCreateDesignReady($id,$change_image=null)
    {

        $label = LabelForm::findOne($id);
        if ($label->load(Yii::$app->request->post())) {
            $label->image_file=UploadedFile::getInstance($label, 'image_file');
            $label->image_crop_file=UploadedFile::getInstance($label, 'image_crop_file');
            $label->image_extended_file=UploadedFile::getInstance($label, 'image_extended_file');
            if ($change_image!=1) $label->design_file_file=UploadedFile::getInstance($label, 'design_file_file');
            if ($change_image!=1) $label->status_id=3;
            if ($change_image!=1) $label->date_of_design=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            if ($label->upload()){
                if ($label->save()) {
                    Yii::$app->session->setFlash('success', 'Дизайн готов');
                    return $this->redirect(['label/view', 'id' => $id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка');
                }
            }

        }
        return $this->render('design_ready', compact('label','change_image'));
    }
    public function actionCreatePrepressReady($id)
    {
        $label = LabelForm::findOne($id);
        if ($label->load(Yii::$app->request->post())) {
//                if ($label->save()) {
//                    Yii::$app->session->setFlash('success', 'Дизайн готов');
//                    return $this->redirect(['label/view', 'id' => $id]);
//                } else {
//                    Yii::$app->session->setFlash('error', 'Ошибка');
//                }
        }
        return $this->render('prepress_ready', compact('label'));
    }
    public function actionSubdpi() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $dpi_id = $parents[0];
                $out = PhotoOutput::$dpi[$dpi_id];
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
}