<?php


namespace app\models;


use yii\db\ActiveRecord;

class Town extends ActiveRecord
{
    public function getRegion(){
        return $this->hasOne(Region::class,['id'=>'region_id']);
    }

    public function attributeLabels(){
        return[
            'id'=>'ID',
            'region_id'=>'Регион',
            'name'=>'Наименование адм.центра',
        ];
    }
    public function rules(){
        return[
            [['region_id'],'integer'],
            [['region_id'],'required'],
            [['name'],'trim'],
        ];
    }

}