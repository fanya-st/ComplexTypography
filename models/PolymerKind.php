<?php


namespace app\models;


use yii\db\ActiveRecord;

class PolymerKind extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'name'=>'Наименование'
        ];
    }

    public function rules(){
        return[
            [['id'],'integer'],
            [['name'],'double'],
            [['name'],'required'],
        ];
    }
}