<?php


namespace app\models;


use yii\db\ActiveRecord;

class Sleeve extends ActiveRecord
{
    public function attributeLabels(){
        return[
            'id'=>'ID',
            'name'=>'Наименование',
        ];
    }
    public function rules(){
        return[
            [['id'],'integer'],
            [['name'],'required'],
            [['name'],'trim'],
        ];
    }
}