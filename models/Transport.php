<?php

namespace app\models;

use Yii;


class Transport extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'transport';
    }

    public function rules()
    {
        return [
            [['name', 'car_number', 'load_capacity'], 'required'],
            [['load_capacity'], 'number'],
            [['subscribe'], 'string'],
            [['subscribe','name','car_number'], 'trim'],
            [['name'], 'string', 'max' => 100],
            [['car_number'], 'string', 'max' => 50],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'car_number' => 'Номер',
            'load_capacity' => 'Грузоподъемность, кг',
            'subscribe' => 'Описание',
        ];
    }
}
