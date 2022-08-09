<?php


namespace app\models;


use yii\db\ActiveRecord;

class Region extends ActiveRecord
{
    public function getSubject(){
        return $this->hasOne(Subject::class,['id'=>'subject_id']);
    }

    public function attributeLabels(){
        return[
            'id'=>'ID',
            'subject_id'=>'Субъект РФ',
            'name'=>'Наименование региона',
        ];
    }
    public function rules(){
        return[
            [['subject_id'],'integer'],
            [['subject_id'],'required'],
            [['name'],'trim'],
        ];
    }
}