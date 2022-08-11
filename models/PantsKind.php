<?php


namespace app\models;


use yii\db\ActiveRecord;

class PantsKind extends ActiveRecord
{

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'name'=>'Наименование'
        ];
    }
}