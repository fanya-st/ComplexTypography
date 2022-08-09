<?php


namespace app\controllers;


use app\models\TimeTracker;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii;

class TimeTrackerController extends Controller
{
    public function behaviors()
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

                ],
            ],
        ];
    }

    public function actionKiosk()
    {
        $this->layout='main_without_navbar';
        $time_tracker=new TimeTracker();
        if ($time_tracker->load(Yii::$app->request->post()) && $time_tracker->validate(Yii::$app->request->post())) {
            if($time_tracker->save()){
                return $this->refresh();
            }else{
                return $this->refresh();
            }
        }
        return $this->render('kiosk',compact('time_tracker'));
    }
}