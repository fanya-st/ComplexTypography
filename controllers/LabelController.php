<?php


namespace app\controllers;

use app\models\Combination;
use app\models\CombinationForm;
use app\models\CustomNav;
use app\models\DesignFileForm;
use app\models\Form;
use app\models\LabelForm;
use app\models\PhotoOutput;
use app\models\PrepressForm;
use Yii;
use app\models\Label;
use app\models\LabelSearch;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use app\models\PrepressFileForm;
use yii\data\ActiveDataProvider;

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
                        'actions' => ['update','approve-design'],
                        'roles' => ['updateOwnLabelManager','updateOwnLabelDesigner','designer_admin','manager_admin'],
                        'roleParams' => function() {
                            return ['label' => Label::findOne(['id' => Yii::$app->request->get('id')])];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['design-ready'],
                        'roles' => ['updateOwnLabelDesigner','designer_admin'],
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
                        'actions' => ['list','view','create-prepress'],
                        'roles' => ['prepress'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['prepress-ready'],
                        'roles' => ['allowToPrepressReadyRule'],
                        'roleParams' => function() {
                            return ['label' => Label::findOne(['id' => Yii::$app->request->get('id')])];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view','create-flexform','flexform-ready'],
                        'roles' => ['laboratory'],
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
                break;
            case 'designer_admin':
                $nav_items=ArrayHelper::merge(
                    CustomNav::getItemByStatusDesigner($label->status_id,$label->id),
                    CustomNav::getItemByStatusPrepress($label->status_id,$label->id)
                );
                break;
            case 'manager':
            case 'manager_admin':
                $nav_items=CustomNav::getItemByStatusManager($label->status_id,$label->id);
                break;
            case 'laboratory':
                $nav_items=CustomNav::getItemByStatusLaboratory($label->status_id,$label->id);
                break;
            case 'prepress':
                $nav_items=CustomNav::getItemByStatusPrepress($label->status_id,$label->id);
                break;
            case 'admin':
                $nav_items=ArrayHelper::merge(
                    CustomNav::getItemByStatusDesigner($label->status_id,$label->id),
                    CustomNav::getItemByStatusManager($label->status_id,$label->id),
                    CustomNav::getItemByStatusPrepress($label->status_id,$label->id),
                    CustomNav::getItemByStatusLaboratory($label->status_id,$label->id)
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
            if ($label->status_id==1){
                if ($label->save()){
                    $label->status_id=2;
                    $label->designer_login=Yii::$app->user->identity->username;
                    Yii::$app->session->setFlash('success','Дизайн создан');
                }
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
        return $this->redirect(['label/view','id'=>$id]);
    }
    public function actionCreatePrepress($id)
    {
        $label=Label::findOne($id);
            if ($label->status_id==4 or $label->status_id==5){
                $label->status_id=6;
                $label->prepress_login=Yii::$app->user->identity->username;
                if ($label->save()){
                    Yii::$app->session->setFlash('success','Этикетка взята в Prepress');
                }
            }else{
                Yii::$app->session->setFlash('error','Этикетка не может быть взята в препресс');
            }
        return $this->redirect(['label/view','id'=>$id]);
    }
    public function actionApproveDesign($id)
    {
        $label=Label::findOne($id);
            if ($label->status_id==3){
                $label->status_id=4;
                if ($label->save()){
                    Yii::$app->session->setFlash('success','Дизайн утвержден');
                }
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
        return $this->redirect(['label/view','id'=>$id]);
    }
    public function actionCreateFlexform($id)
    {
        $label=Label::findOne($id);
        if(!empty($label->combinatedLabel)){
            foreach ($label->combinatedLabel as $label_id){
                $l=Label::findOne($label_id);
                $l->status_id=9;
                $l->laboratory_login=Yii::$app->user->identity->username;
                $l->date_of_flexformready=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                $l->save();
            }
            Yii::$app->session->setFlash('success','Начато изготовление форм');
            return $this->redirect(['label/view','id'=>$id]);
        } else{
            $label->status_id=9;
            $label->laboratory_login=Yii::$app->user->identity->username;
            $label->date_of_flexformready=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            if ($label->save()){
                Yii::$app->session->setFlash('success','Начато изготовление форм');
                return $this->redirect(['label/view','id'=>$id]);
            }else{
                Yii::$app->session->setFlash('error','Ошибка');
            }
        }
    }
    public function actionFlexformReady($id)
    {
        $label=Label::findOne($id);
        $flexform=new Form();
        if(isset($label->combination))
        $forms_id=Form::find()->select('id')->where(['combination_id'=>$label->combination])->column();
        else $forms_id=Form::find()->select('id')->where(['label_id'=>$label->id])->column();
        $forms = new ActiveDataProvider([
            'query' => Form::find()->where(['id'=>$forms_id])
        ]);
//        if(!empty($label->combinatedLabel)){
//
//        }
//            foreach ($label->combinatedLabel as $label_id){
//                $l=Label::findOne($label_id);
//                $l->status_id=9;
//                $l->save();
//            }
//            Yii::$app->session->setFlash('success','Начато изготовление форм');
//            return $this->redirect(['label/view','id'=>$id]);
//        } else{
//            $label->status_id=9;
//            if ($label->save()){
//                Yii::$app->session->setFlash('success','Начато изготовление форм');
//                return $this->redirect(['label/view','id'=>$id]);
//            }else{
//                Yii::$app->session->setFlash('error','Ошибка');
//            }
//        }
        return $this->render('flexform_ready', compact('label','flexform','forms'));
    }
    public function actionDesignReady($id,$change_image=null)
    {
        $design_file=DesignFileForm::findOne($id);
        $label = LabelForm::findOne($id);
        if ($label->load(Yii::$app->request->post())&&$design_file->load(Yii::$app->request->post())) {
            $design_file->image_file=UploadedFile::getInstance($design_file, 'image_file');
            $design_file->image_crop_file=UploadedFile::getInstance($design_file, 'image_crop_file');
            $design_file->image_extended_file=UploadedFile::getInstance($design_file, 'image_extended_file');
            $design_file->design_file_file=UploadedFile::getInstance($design_file, 'design_file_file');
//            if ($change_image!=1) $design_file->design_file_file=UploadedFile::getInstance($design_file, 'design_file_file');
            if ($change_image!=1) $label->status_id=3;
            if ($change_image!=1) $label->date_of_design=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
            if ($design_file->upload($label)){
                if ($label->save()) {
                    Yii::$app->session->setFlash('success', 'Дизайн готов');
                    return $this->redirect(['label/view', 'id' => $id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка');
                }
            }

        }
        return $this->render('design_ready', compact('label','design_file','change_image'));
    }
    public function actionPrepressReady($id)
    {
        $prepress=new PrepressForm;
        $prepress_file=PrepressFileForm::findOne($id); //отдельная модель для загрузки файла препресса
        $label=Label::findOne($id);
//        if($label->status_id!=7)
        $prepress->lpi=154;//по умолчанию линиатура равна 154
        if ($label->load(Yii::$app->request->post())&&$prepress->load(Yii::$app->request->post())&&$prepress_file->load(Yii::$app->request->post())) {
            $prepress_file->prepress_design_file_file=UploadedFile::getInstance($prepress_file, 'prepress_design_file_file'); // загружаем файл препресса
            if ($prepress_file->upload($label)){ //загружаем файл препресса на сервер
                $label->date_of_prepress=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'); //меняем дату препресса
                $label->status_id=7;
                if($label->save()){
                    //если формы совмещены
                    if (!empty($prepress->combination_label)){
                        //создаем новое совмещение
                        $combination=new Combination;
                        $combination->save();
                        //
                        //присваиваем текущую этикетку к созданному совмещению
                        $old_combination_label=CombinationForm::findOne(['label_id'=>$label->id]);
                        $old_combination_label->delete();
                        $combination_label=new CombinationForm();
                        $combination_label->label_id=$label->id;
                        $combination_label->combination_id=$combination->id;
                        $combination_label->save();
                        //
                        foreach ($prepress->combination_label as $label_id){
                            $combination_label=Label::findOne($label_id);
                            $old_combination_label=CombinationForm::findOne(['label_id'=>$label_id]);
                            $old_combination_label->delete();//удаляем старое совмещение
                            $combination_label->status_id=7;
                            $combination_label->prepress_design_file=$label->prepress_design_file; //присваиваем файл препресс к совмещенным этикткам
                            $combination_label->date_of_prepress=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                            $combination_label->save();
                            $combination_label=new CombinationForm();
                            $combination_label->label_id=$label_id;
                            $combination_label->combination_id=$combination->id;
                            $combination_label->save();
                        }
                        $prepress->combination_id=$combination->id;
                    }//если формы совмещены

                    //создаем формы для выбранных пантонов
                    Form::createPantoneForm($prepress,$label->id,$prepress->set_form_count,$prepress->prepress_pantone_list);
                    //создаем форму для трафарета
                    if($label->stencil ==1 OR ArrayHelper::isIn(1,Label::find()->select('stencil')->where(['id' => $prepress->combination_label])->column()))
                        Form::createStencilForm($prepress,$label->id,$prepress->set_form_count);
                    //создаем форму для фольги
                    if($label->foil_id !=1 OR ArrayHelper::isIn(2,Label::find()->select('foil_id')->where(['id' => $prepress->combination_label])->column())
                        OR ArrayHelper::isIn(3,Label::find()->select('foil_id')->where(['id' => $prepress->combination_label])->column())
                        OR ArrayHelper::isIn(4,Label::find()->select('foil_id')->where(['id' => $prepress->combination_label])->column())
                    )
                        Form::createFoilForm($prepress,$label->id,$prepress->set_form_count);
                    //создаем лаковую форму
                    if($label->varnish_id !=0 OR ArrayHelper::isIn(1,Label::find()->select('varnish_id')->where(['id' => $prepress->combination_label])->column())
                        OR ArrayHelper::isIn(2,Label::find()->select('varnish_id')->where(['id' => $prepress->combination_label])->column())
                        OR ArrayHelper::isIn(3,Label::find()->select('varnish_id')->where(['id' => $prepress->combination_label])->column())
                    )
                        Form::createVarnishForm($prepress,$label->id,$prepress->set_form_count);
                    Yii::$app->session->setFlash('success', 'Prepress готов');
                    return $this->redirect(['label/view', 'id' => $id]);
                }
                else {
                    Yii::$app->session->setFlash('error', 'Ошибка');
                }
            }
        }
        return $this->render('prepress_ready', compact('label','prepress','prepress_file'));
    }
    public function actionSubdpi() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $dpi_id = $parents[0];
                $out = PhotoOutput::$dpi[$dpi_id];
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
}