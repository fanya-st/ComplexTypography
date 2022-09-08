<?php

namespace app\models;

use Yii;


class Shelf extends \yii\db\ActiveRecord
{
    public function getRack(){
        return $this->hasOne(Rack::class,['id'=>'rack_id']);
    }

    public function getPaperWarehouse()
    {
        return $this->hasMany(PaperWarehouse::class,['shelf_id'=>'id']);
    }

    public function getEnvelope()
    {
        return $this->hasMany(Envelope::class,['shelf_id'=>'id']);
    }

    public function getPantoneWarehouse()
    {
        return $this->hasMany(PantoneWarehouse::class,['shelf_id'=>'id']);
    }


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
