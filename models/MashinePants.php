<?php


namespace app\models;


use yii\db\ActiveRecord;

class MashinePants extends ActiveRecord
{
    public function getMashine(){
        return $this->hasOne(Mashine::class,['id'=>'mashine_id']);
    }

    public function getPants(){
        return $this->hasOne(Pants::class,['id'=>'pants_id']);
    }

}