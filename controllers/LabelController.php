<?php


namespace app\controllers;

use app\models\CustomNav;
use app\models\LabelForm;
use Yii;
use app\models\Label;
use app\models\LabelSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

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
                        'actions' => ['update','create-design-ready'],
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
                        'actions' => ['list','view'],
                        'roles' => ['prepress'],
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
            case 'designer_admin':
            case 'admin':
                $nav_items=CustomNav::getItemByStatusDesigner($label->status_id,$label->id);
                break;
            case 'manager':
            case 'manager_admin':
                $nav_items=[['label' => 'Менеджер', 'items' => [
            ['label' => 'Внести изменения', 'url' => ['label/update','id'=>Yii::$app->request->get('id')]],
            ['label' => 'Создать подобную', 'url' => ['label/create']],
            ['label' => 'Заказ в печать', 'url' => ['order/create','label_id'=>Yii::$app->request->get('id'),'blank'=>0]]
        ]
                ]
                ];
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
                return $this-> refresh();
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
                    return $this-> refresh();
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
    public function actionCreateDesignReady($id,$change_image=null)
    {

        $label = LabelForm::findOne($id);
        if ($label->load(Yii::$app->request->post())) {
            $label->image_file=UploadedFile::getInstance($label, 'image_file');
            $label->image_crop_file=UploadedFile::getInstance($label, 'image_crop_file');
            $label->image_extended_file=UploadedFile::getInstance($label, 'image_extended_file');
            if ($change_image!=1) $label->design_file_file=UploadedFile::getInstance($label, 'design_file_file');
            if ($change_image!=1) $label->status_id=3;
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
}