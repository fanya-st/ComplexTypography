<?php


namespace app\models;


use yii\db\ActiveRecord;

class CustomerStatus extends ActiveRecord
{
    public static $customer_status = [
        1=>'Активный',
        2=>'Потенциальный',
        3=>'Архивный',
        4=>'Хлам',
    ];
}