<?php


namespace app\controllers;


use app\models\TimeTracker;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\TimeTrackerSearch;
use yii;

class TimeTrackerController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['kiosk'],
                        'roles' => ['?','@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['admin'],
                    ],

                ],
            ],
        ];
    }

    public function actionKiosk(): yii\web\Response|string
    {
        $this->layout='main_without_navbar';
        $time_tracker=new TimeTracker();
        if ($time_tracker->load(Yii::$app->request->post()) && $time_tracker->validate()) {
            if($time_tracker->save()){
                return $this->refresh();
            }else{
                return $this->refresh();
            }
        }
        return $this->render('kiosk',compact('time_tracker'));
    }
    public function actionIndex(): string
    {
        $searchModel = new TimeTrackerSearch();
        $dataProvider = $searchModel->search($this->request->post());
//        $data = $dataProvider->getModels();
        $timesheet = TimeTracker::getTimesheet($dataProvider->getModels());

        return $this->render('index',compact('searchModel','timesheet','dataProvider'));
    }
}