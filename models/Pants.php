<?php


namespace app\models;


use yii\db\ActiveRecord;

class Pants extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'name'=>'Наименование штанца'
        ];
    }
}