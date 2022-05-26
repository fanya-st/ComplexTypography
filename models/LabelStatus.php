<?php


namespace app\models;


use yii\db\ActiveRecord;

class LabelStatus extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'name'=>'Статус этикетки',
        ];
    }
}