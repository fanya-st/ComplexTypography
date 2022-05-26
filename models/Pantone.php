<?php


namespace app\models;


use yii\db\ActiveRecord;

class Pantone extends ActiveRecord
{
    public function getPantoneName(){
        return $this->name;
    }
}