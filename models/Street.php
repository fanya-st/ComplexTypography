<?php


namespace app\models;


use yii\db\ActiveRecord;

class Street extends ActiveRecord
{
    public function getTown(){
        return $this->hasOne(Town::class,['id'=>'town_id']);
    }

    public function attributeLabels(){
        return[
            'id'=>'ID',
            'town_id'=>'Адм.центр',
            'name'=>'Наименование улицы',
        ];
    }
    public function rules(){
        return[
            [['town_id'],'integer'],
            [['town_id'],'required'],
            [['name'],'trim'],
        ];
    }

}