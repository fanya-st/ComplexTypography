<?php


namespace app\controllers;


use yii\web\Controller;

class CalendarController extends Controller
{
    public function actionView(){
        return $this->render('view');
    }

}