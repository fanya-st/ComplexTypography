<?php


namespace app\controllers;

use app\models\LabelForm;
use Yii;
use app\models\Label;
use app\models\LabelSearch;
use yii\filters\AccessControl;
use yii\web\Controller;

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
                        'roles' => ['updateOwnLabel','designer_admin','manager_admin'],
                        'roleParams' => function() {
                            return ['label' => Label::findOne(['id' => Yii::$app->request->get('id')])];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['list','view'],
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
        switch (Yii::$app->user->identity->group) {
            case 'designer':
            case 'designer_admin':
                    $nav_items=[
                        ['label' => 'Дизайнер', 'items' => [
                            ['label' => 'Внести изменения', 'url' => ['label/update','id'=>Yii::$app->request->get('id')]],
                        ]
                        ]
                    ];
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
        $label=Label::findOne($id);
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
}