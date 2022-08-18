<?php

namespace app\models;

use Yii;


class Rack extends \yii\db\ActiveRecord
{
    public function getWarehouse(){
       return $this->hasOne(Warehouse::class,['id'=>'warehouse_id']);
    }

    public static function tableName()
    {
        return 'rack';
    }


    public function rules()
    {
        return [
            [['warehouse_id'], 'required'],
            [['warehouse_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Описание',
            'warehouse_id' => 'Склад',
        ];
    }
}
