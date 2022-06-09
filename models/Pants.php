<?php


namespace app\models;


use yii\db\ActiveRecord;

class Pants extends ActiveRecord
{
    public function getShaft(){
        return $this->hasOne(Shaft::class,['id'=>'shaft_id']);
    }

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'name'=>'Наименование штанца'
        ];
    }
}