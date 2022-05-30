<?php


namespace app\models;

use yii\db\ActiveRecord;


class Customer extends ActiveRecord
{
    public function getCustomerStatus(){
        return $this->hasOne(CustomerStatus::class,['id'=>'status_id']);
    }
    public function getCustomerStatusName(){
        return $this->customerStatus->name;
    }

    public function attributeLabels()
    {
        return [
            'name'=>'Заказчик',
            'id'=>'Заказчик',
            'customerStatusName'=>'Статус',
        ];
    }
}