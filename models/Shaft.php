<?php


namespace app\models;


use yii\db\ActiveRecord;

class Shaft extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'name'=>'Наименование вала'
        ];
    }
}