<?php


namespace app\models;


use yii\db\ActiveRecord;

class KnifeKind extends ActiveRecord
{

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'name'=>'Наименование'
        ];
    }
}