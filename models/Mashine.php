<?php


namespace app\models;


use yii\db\ActiveRecord;

class Mashine extends ActiveRecord
{
    public function getCalcMashineParamPrice(){
        return $this->hasMany(CalcMashineParamPrice::class,['mashine_id'=>'id']);
    }


    public function attributeLabels()
    {
        return [
            'name'=>'Название станка'
        ];
    }
}