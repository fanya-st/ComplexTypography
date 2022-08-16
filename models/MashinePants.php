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

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'mashine_id'=>'Станок',
            'pants_id'=>'Штанец',
        ];
    }

    public function rules(){
        return[
            [['id','mashine_id','pants_id'],'integer'],
        ];
    }
}