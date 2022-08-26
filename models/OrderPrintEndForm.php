<?php

namespace app\models;

use yii\db\ActiveRecord;

class OrderPrintEndForm extends Order
{
    public static function tableName(){
        return 'order';
    }

    public function rules(){
        return[
            [['printed_circulation'],'required'],
        ];
    }
}