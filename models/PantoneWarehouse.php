<?php

namespace app\models;

use Yii;


class PantoneWarehouse extends \yii\db\ActiveRecord
{
    public function getPantone(){
        return $this->hasOne(Pantone::class,['id'=>'pantone_id']);
    }

    public static function tableName()
    {
        return 'pantone_warehouse';
    }

    public function getShelf(){
        return $this->hasOne(Shelf::class,['id'=>'shelf_id']);
    }

    public function rules()
    {
        return [
            [['pantone_id','weight'], 'required'],
            [['pantone_id','shelf_id','id'], 'integer'],
            [['weight'], 'number'],
            [['date'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pantone_id' => 'PANTONE',
            'weight' => 'Вес, кг',
            'date' => 'Дата добавления',
        ];
    }
}
