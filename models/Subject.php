<?php


namespace app\models;


use yii\db\ActiveRecord;

class Subject extends ActiveRecord
{
    public function attributeLabels(){
        return[
            'id'=>'ID',
            'name'=>'Наименование субъекта РФ',
        ];
    }
    public function rules(){
        return[
            [['name'],'required'],
            [['name'],'trim'],
        ];
    }
}