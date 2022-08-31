<?php


namespace app\models;


use yii\base\Model;

class OrderStatus extends Model
{
    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'name'=>'Статус заказа',
        ];
    }

    public static $order_status = [
        1=>'Новый',
        2=>'В печати',
        3=>'Печать приостановлена',
        4=>'Напечатан',
        5=>'Нарезка/Перемотка',
        6=>'Нарезка завршена',
        7=>'Упаковка',
        8=>'На складе ГП',
        9=>'Закрыт',
        10=>'Брак',
    ];

    public $id;
    public $name;
}