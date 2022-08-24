<?php

namespace app\models;

use Yii;


class Shelf extends \yii\db\ActiveRecord
{
    public function getRack(){
        return $this->hasOne(Rack::class,['id'=>'rack_id']);
    }
//    public function getWarehouse(){
//        return $this->hasOne(Warehouse::class,['id'=>'warehouse_id'])->via('rack');
//    }

    public static function tableName()
    {
        return 'shelf';
    }


    public function rules()
    {
        return [
            [['rack_id'], 'required'],
            [['rack_id'], 'integer'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rack_id' => 'Стеллаж',
        ];
    }
}
