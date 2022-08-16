<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii;

class TimeTracker extends ActiveRecord
{
    public function attributeLabels(){
        return[
            'date_of_action'=>'Дата действия',
            'action'=>'Действие',//'0'-приход на работу,'1'-уход с работы
            'employer_login'=>'Логин сотрудника',
        ];
    }
    public function rules(){
        return[
            [['employer_login'],'required'],
            [['employer_login'],'trim'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
//                    if($past_record=TimeTracker::find()->where(['employer_login'=>$this->employer_login])->orderBy('date_of_action DESC')->one()){
//                        $start=date_create($past_record->date_of_action);
//                        $diff=date_diff($start,date_create());
//                        if(($diff->h+24*$diff->days) >= (User::findWorkingTimeByUserName($this->employer_login)+2)){
//                            $this->action=0;
//                            Yii::$app->session->setFlash('success', 'Добро пожаловать, '.User::findByUsername($this->employer_login)->I);
//                        } else {
//                            $this->action=1;
//                            Yii::$app->session->setFlash('success', 'До свидания, '.User::findByUsername($this->employer_login)->I);
//                        }
//                    }else{
//                        $this->action=0;
//                        Yii::$app->session->setFlash('success', 'Добро пожаловать, '.User::findByUsername($this->employer_login)->I);
//                    }
                Yii::$app->session->setFlash('success', 'Спасибо, что отметились, '.User::findByUsername($this->employer_login)->I);
            }
            return true;
        } else {
            return false;
        }
    }
}