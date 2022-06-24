<?php


namespace app\controllers;
//namespace app\models;

use app\models\Combination;
use app\models\CombinationForm;
use app\models\CustomNav;
use app\models\DesignFileForm;
use app\models\Form;
use app\models\FormOrderHistory;
use app\models\LabelForm;
use app\models\Order;
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
use app\models\Envelope;

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
                        'actions' => ['update'],
                        'roles' => ['updateOwnLabelManager','designer_admin','manager_admin'],
                        'roleParams' => function() {
                            return ['label' => Label::findOne(['id' => Yii::$app->request->get('id')])];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['approve-design'],
                        'roles' => ['updateOwnLabelManager','manager_admin'],
                        'roleParams' => function() {
                            return ['label' => Label::findOne(['id' => Yii::$app->request->get('id')])];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['design-ready'],
                        'roles' => ['allowToDesignReadyRule','designer_admin'],
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
                        'actions' => ['create-same'],
                        'roles' => ['updateOwnLabelManager','manager_admin','designer_admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view','create-prepress','re-prepress'],
                        'roles' => ['prepress'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['prepress-delete-form'],
                        'roles' => ['prepress'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['prepress-ready','combinate-label'],
                        'roles' => ['allowToPrepressReadyRule'],
                        'roleParams' => function() {
                            return ['label' => Label::findOne(['id' => Yii::$app->request->get('id')])];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['flexform-ready'],
                        'roles' => ['allowToFlexformReadyRule'],
                        'roleParams' => function() {
                            return ['label' => Label::findOne(['id' => Yii::$app->request->get('id')])];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view','create-flexform','re-flexform-ready'],
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
                    CustomNav::getItemByStatusPrepress($label->status_id,$label->id),
                    CustomNav::getItemByStatusLaboratory($label->status_id,$label->id)
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
            if($model->load(Yii::$app->request->post()) && $model->validate(Yii::$app->request->post())){
                if ($model->save()){
                    Yii::info("Создана этикетка пользователем ".Yii::$app->user->identity->username.' №'.$model->id);
                    Yii::$app->session->setFlash('success','Этикетка создана');
                    return $this->redirect(['label/view','id'=>$model->id]);
                }else{
                    Yii::$app->session->setFlash('error','Ошибка');
                }
            }
            return $this->render('create', compact('model'));

    }
    public function actionCreateSame($id)
    {
            $model=LabelForm::findOne($id);
            if($model->load(Yii::$app->request->post())){
                $model->setIsNewRecord(true);
                unset($model->id);
                $model->parent_label=$id;
                $model->status_id=1;
            if ($model->save()){
                Yii::info("Создана этикетка пользователем ".Yii::$app->user->identity->username.' №'.$model->id);
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
            if ($label->status_id==1 and ($label->designer_login == null OR $label->designer_login==Yii::$app->user->identity->username)){
                    $label->status_id=2;
                    $label->designer_login=Yii::$app->user->identity->username;
                if ($label->save()){
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
        $label = Label::findOne($id);
        if($label->status_id==7 OR $label->status_id==8){
        if (!empty($label->combinatedLabel)) {
            foreach ($label->combinatedLabel as $label_id) {
                $l = Label::findOne($label_id);
                $l->status_id = 9;
                $l->laboratory_login = Yii::$app->user->identity->username;
                if ($l->save()) {
                    Yii::$app->session->setFlash('success', 'Начато изготовление форм');
                }
            }
        } else {
            $label->status_id = 9;
            $label->laboratory_login = Yii::$app->user->identity->username;
            if ($label->save()) {
                Yii::$app->session->setFlash('success', 'Начато изготовление форм');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }
    }else{
            Yii::$app->session->setFlash('error', 'Ошибка этикетка не готова для изготовления форм');
        }
        return $this->redirect(['label/view','id'=>$id]);
    }
    public function actionFlexformReady($id)
    {
        $cur_label=Label::findOne($id);
        $flexform=new Form();
        $envelope=new Envelope();
        if(isset($cur_label->combination))
        $forms_id=Form::find()->select('id')->where(['combination_id'=>$cur_label->combination->combination_id])->column();
        else $forms_id=Form::find()->select('id')->where(['label_id'=>$cur_label->id])->column();
        $forms = new ActiveDataProvider([
            'query' => Form::find()->where(['id'=>$forms_id])
        ]);
        if ($flexform->load(Yii::$app->request->post()) && $envelope->load(Yii::$app->request->post()) && $cur_label->load(Yii::$app->request->post())) {
            if($envelope->new_checkbox!=1) $envelope=Envelope::findOne($flexform->envelope_id);
            else {
                $envelope->rack= $envelope->rack_id;
                $envelope->shelf= $envelope->shelf_id;
                $envelope->save();
            }

            foreach($forms_id as $id){
                $ready_form=Form::findOne($id);
                $ready_form->ready=1;
                $ready_form->envelope_id=$envelope->id;
                $ready_form->polymer_id=$flexform->polymer_id;
                $ready_form->save();
                //записываем исзготовленные новые формы к заказу
                $form_history=new FormOrderHistory();
                $order=Order::findOne(['label_id'=>$cur_label->id]);
                if(!empty($order->combinationOrder)){
                    $form_history->combination_print_order_id=$order->combinationOrder->combination_id;
                }else {
                    $form_history->order_id=$order->id;
                }
                $form_history->form_id=$id;
                $form_history->save();
                //записываем исзготовленные новые формы к заказу
            }
            if(!empty($cur_label->combinatedLabel)){
                foreach ($cur_label->combinatedLabel as $label_id){
                    $l=Label::findOne($label_id);
                    $l->status_id=10;
                    $l->laboratory_note=$cur_label->laboratory_note;
                    $l->date_of_flexformready=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                    $l->save();
                }
            }
            else{
                $cur_label->status_id=10;
                $cur_label->date_of_flexformready=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                $cur_label->save();
            }

            Yii::$app->session->setFlash('success','Готов к печати');
            return $this->redirect(['label/view','id'=>$cur_label->id]);
        }
        return $this->render('flexform_ready', compact('cur_label','flexform','forms','envelope'));
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
        $label=Label::findOne($id);
        $new_form=new Form();
        $new_form->lpi=154;
        $new_form->foil_stencil_varnish=0;
        $prepress_file=PrepressFileForm::findOne($id);
        if(isset($label->combination)){
            $new_form->combination_id=$label->combination->combination_id;
            $forms_id=Form::find()->select('id')->where(['combination_id'=>$label->combination->combination_id])->column();
        }
            else {
                $new_form->label_id=$label->id;
                $forms_id=Form::find()->select('id')->where(['label_id'=>$id])->column();
            }
        $forms = new ActiveDataProvider([
            'query' => Form::find()->where(['id'=>$forms_id])
        ]);
        if ($label->load(Yii::$app->request->post())&&$prepress_file->load(Yii::$app->request->post())) {
            $prepress_file->prepress_design_file_file=UploadedFile::getInstance($prepress_file, 'prepress_design_file_file');
            if ($prepress_file->upload($label)){ //загружаем файл препресса на сервер
                if(isset($label->combination)){
                    foreach ($label->combinatedLabel->label_id as $label_id){
                        $l=Label::findOne($label_id);
                        $l->status_id=7;
                        $l->prepress_design_file=$label->prepress_design_file;
                        $l->date_of_prepress=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'); //меняем дату препресса
                        $l->save();
                    }
                }else {
                    $label->date_of_prepress=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'); //меняем дату препресса
                    $label->status_id=7;
                    $label->save();
                }
            }
            return $this->redirect(['label/view', 'id' => $id]);
        }
        if ($new_form->load(Yii::$app->request->post()) && $new_form->validate(Yii::$app->request->post())) {
            $count=$new_form->set_form_count;
            $foil_stencil_varnish=$new_form->foil_stencil_varnish;
            if ($foil_stencil_varnish=='0') {
                $i = $count;
                while ($i > 0) {
                    unset($new_form->id);
                    unset($new_form->varnish_form);
                    unset($new_form->foil_form);
                    unset($new_form->stencil_form);
                    $new_form->setisNewRecord(true);
                        $new_form->save();
                    $i--;
                }
            }
            if ($foil_stencil_varnish=='varnish_form'){
                $i=$count;
                while ($i>0){
                    unset($new_form->id);
                    unset($new_form->foil_form);
                    unset($new_form->pantone_id);
                    unset($new_form->stencil_form);
                    $new_form->setisNewRecord(true);
                    $new_form->varnish_form=1;
                        $new_form->save();
                    $i--;
                }
            }
            if ($foil_stencil_varnish=='stencil_form'){
                $i=$count;
                while ($i>0){
                    unset($new_form->id);
                    unset($new_form->varnish_form);
                    unset($new_form->pantone_id);
                    unset($new_form->foil_form);
                    $new_form->setisNewRecord(true);
                    $new_form->stencil_form=1;
                        $new_form->save();
                    $i--;
                }
            }
            if ($foil_stencil_varnish=='foil_form'){
                $i=$count;
                while ($i>0){
                    unset($new_form->id);
                    unset($new_form->varnish_form);
                    unset($new_form->pantone_id);
                    unset($new_form->stencil_form);
                    $new_form->setisNewRecord(true);
                    $new_form->foil_form=1;
                        $new_form->save();
                    $i--;
                }
            }
            $this->refresh();
        }
        return $this->render('prepress_ready', compact('label','new_form','forms','prepress_file'));
    }
    public function actionCombinateLabel($id)
    {
        $label=Label::findOne($id);
        $new_combination_form=new CombinationForm();
        if ($new_combination_form->load(Yii::$app->request->post())) {
            $new_combination=new Combination();
            $new_combination->save();
            foreach($new_combination_form->label_id as $label_id){
                $temp=new CombinationForm();
                $temp->combination_id=$new_combination->id;
                $temp->label_id=$label_id;
                $temp->save();
            }
            return $this->redirect(['label/view', 'id' => $id]);
        }
        return $this->render('combinate-label', compact('label','new_combination_form'));
    }
    public function actionPrepressDeleteForm($form_id)
    {
        $form=Form::findOne($form_id);
        $form->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionRePrepress($id)
    {
        $prepress_file=PrepressFileForm::findOne($id);
        $cur_label=Label::findOne($id);
        if(isset($cur_label->combination))
            $forms_id=Form::find()->select('id')->where(['combination_id'=>$cur_label->combination->combination_id])->column();
        else $forms_id=Form::find()->select('id')->where(['label_id'=>$cur_label->id])->column();
        $forms = new ActiveDataProvider([
            'query' => Form::find()->where(['id'=>$forms_id])->andWhere(['not',['form_defect_id'=>null]])
        ]);
        if ($prepress_file->load(Yii::$app->request->post())) {
            $prepress_file->prepress_design_file_file=UploadedFile::getInstance($prepress_file, 'prepress_design_file_file');
            if ($prepress_file->upload($cur_label)){
                $cur_label->status_id=8;
                if (!empty($cur_label->combinatedLabel)){
                    foreach ($cur_label->combinatedLabel as $com_label){
                        $l=Label::findOne($com_label);
                        $l->status_id=8;
                        $l->prepress_design_file=$cur_label->prepress_design_file;
                        $l->save();
                    }
                }
                if($cur_label->save()){
                    Yii::$app->session->setFlash('success', 'Перевывод готов');
                }else{
                    Yii::$app->session->setFlash('error', 'Ошибка');
                }
            }
            return $this->redirect(['label/view', 'id' => $id]);
        }
        return $this->render('re-prepress', compact('cur_label','forms','prepress_file'));
    }

    public function actionReFlexformReady($id)
    {
        $cur_label=Label::findOne($id);
        if(isset($cur_label->combination))
            $forms_id=Form::find()->select('id')->where(['combination_id'=>$cur_label->combination->combination_id])->column();
        else $forms_id=Form::find()->select('id')->where(['label_id'=>$cur_label->id])->column();
        $forms = new ActiveDataProvider([
            'query' => Form::find()->where(['id'=>$forms_id])->andWhere(['not',['form_defect_id'=>null]])
        ]);
        if ($cur_label->load(Yii::$app->request->post())) {
            foreach (Form::find()->where(['id'=>$forms_id])->andWhere(['not',['form_defect_id'=>null]])->column() as $form_id){
                $f=Form::findOne($form_id);
                $f->form_defect_id=Null;
                $f->ready=1;
                $f->save();
                //записываем исзготовленные новые формы к заказу
                $form_history=new FormOrderHistory();
                $order=Order::findOne(['label_id'=>$cur_label->id,'status_id'=>3]);
                if(!empty($order->combinationOrder)){
                    $form_history->combination_print_order_id=$order->combinationOrder->combination_id;
                }else {
                    $form_history->order_id=$order->id;
                }
                $form_history->form_id=$form_id;
                $form_history->save();
                //записываем исзготовленные новые формы к заказу
            }
            if (!empty($cur_label->combinatedLabel)){
                foreach ($cur_label->combinatedLabel as $com_label){
                    $l=Label::findOne($com_label);
                    $l->status_id=10;
                    $l->laboratory_note=$cur_label->laboratory_note;
                    $l->save();
                }
            }
            $cur_label->status_id=10;
            if($cur_label->save()){
                Yii::$app->session->setFlash('success', 'Формы готовы');
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
            return $this->redirect(['label/view', 'id' => $id]);
        }
        return $this->render('re-flexform_ready', compact('cur_label','forms'));
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