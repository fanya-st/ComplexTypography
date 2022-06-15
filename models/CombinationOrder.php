<?php


namespace app\models;


use yii\db\ActiveRecord;

class CombinationOrder extends ActiveRecord
{
    public function rules(){
        return[
            [['order_id'],'safe']
        ];
    }
}