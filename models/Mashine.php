<?php


namespace app\models;


use yii\db\ActiveRecord;

class Mashine extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'name'=>'Название станка'
        ];
    }
}