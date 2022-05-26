<?php


namespace app\models;


use yii\db\ActiveRecord;

class VarnishStatus extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'name'=>'Вид лака'
        ];
    }
}