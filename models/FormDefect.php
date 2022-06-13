<?php


namespace app\models;


use yii\db\ActiveRecord;

class FormDefect extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'name'=>'Дефект',
        ];
    }
}