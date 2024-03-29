<?php

namespace app\models;

use Yii;


class MashinePantone extends \yii\db\ActiveRecord
{
    public function getMashine(){
        return $this->hasOne(Mashine::class,['id'=>'mashine_id']);
    }

    public function getPantone(){
        return $this->hasOne(Pantone::class,['id'=>'pantone_id']);
    }

    public static function tableName()
    {
        return 'mashine_pantone';
    }


    public function rules()
    {
        return [
            [['pantone_id', 'mashine_id'], 'required'],
            [['pantone_id', 'mashine_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pantone_id' => 'PANTONE',
            'mashine_id' => 'Станок',
        ];
    }
}
