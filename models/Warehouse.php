<?php

namespace app\models;

use Yii;


class Warehouse extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'warehouse';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
        ];
    }
}
