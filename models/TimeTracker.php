<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii;
use yii\helpers\ArrayHelper;

class TimeTracker extends ActiveRecord
{
    public function attributeLabels(){
        return[
            'date_of_action'=>'Дата действия',
            'action'=>'Действие',//'0'-приход на работу,'1'-уход с работы
            'employee_login'=>'Логин сотрудника',
        ];
    }
    public function rules(){
        return[
            [['employee_login'],'required'],
            [['employee_login'],'string','max'=>100],
            [['employee_login'],'trim'],
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
                Yii::$app->session->setFlash('success', 'Спасибо, что отметились, '.User::findByUsername($this->employee_login)->I);
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getTimesheet($data){
        foreach($data as &$record1){
            foreach($data as &$record2){
                if($record1->id != $record2->id && $record1->employee_login == $record2->employee_login){
                    $diff=date_diff(date_create($record1->date_of_action),date_create($record2->date_of_action));
                    $hours_diff=$diff->h+24*$diff->days+$diff->h/60;
                    if($hours_diff<=12){
                        ArrayHelper::setValue($timesheet, $record1->employee_login.'-'.$record1->id.'-'.$record2->id.'.hours', $hours_diff);
                        ArrayHelper::setValue($timesheet, $record1->employee_login.'-'.$record1->id.'-'.$record2->id.'.employee', $record1->employee_login);
                        ArrayHelper::setValue($timesheet, $record1->employee_login.'-'.$record1->id.'-'.$record2->id.'.date', date_format(date_create($record1->date_of_action),"Y-m-d"));
                        ArrayHelper::setValue($timesheet, $record1->employee_login.'-'.$record1->id.'-'.$record2->id.'.start', $record1->date_of_action);
                        ArrayHelper::setValue($timesheet, $record1->employee_login.'-'.$record1->id.'-'.$record2->id.'.id-start', $record1->id);
                        ArrayHelper::setValue($timesheet, $record1->employee_login.'-'.$record1->id.'-'.$record2->id.'.end', $record2->date_of_action);
                        ArrayHelper::setValue($timesheet, $record1->employee_login.'-'.$record1->id.'-'.$record2->id.'.id-end', $record2->id);

                        unset($data[key($data)]);
                        break;
                    }else{
                        ArrayHelper::setValue($timesheet, $record1->employee_login.'-'.$record1->id.'-.employee', $record1->employee_login);
                        ArrayHelper::setValue($timesheet, $record1->employee_login.'-'.$record1->id.'-.date', date_format(date_create($record1->date_of_action),"Y-m-d"));
                        ArrayHelper::setValue($timesheet, $record1->employee_login.'-'.$record1->id.'-.start', $record1->date_of_action);
                        ArrayHelper::setValue($timesheet, $record1->employee_login.'-'.$record1->id.'-.id-start', $record1->id);
                    }
                }
            }

            unset($data[key($data)]);
            unset($record2);
        }
        unset($record1);
//        var_dump($data1);
        return $timesheet;
    }
}