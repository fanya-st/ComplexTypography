<?php


namespace app\models;


use yii\db\ActiveRecord;

class Shaft extends ActiveRecord
{
    public function getPolymerKind(){
        return $this->hasOne(PolymerKind::class,['id'=>'polymer_kind_id']);
    }

    public function attributeLabels()
    {
        return [
            'name'=>'Длина, мм',
            'id'=>'ID',
            'polymer_kind_id'=>'Полимер',
        ];
    }

    public function rules(){
        return[
            [['id','polymer_kind_id'],'integer'],
            [['name'],'double'],
            [['name','polymer_kind_id'],'required'],
        ];
    }
}