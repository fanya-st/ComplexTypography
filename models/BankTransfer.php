<?php

namespace app\models;

use Yii;


class BankTransfer extends \yii\db\ActiveRecord
{

    public function getCustomer(){
        return $this->hasOne(Customer::class,['id'=>'customer_id']);
    }

    public static function tableName()
    {
        return 'bank_transfer';
    }

    public function rules()
    {
        return [
            [['date_of_create', 'date'], 'safe'],
            [['customer_id', 'date', 'sum'], 'required'],
            [['customer_id'], 'integer'],
            [[ 'sum'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_of_create' => 'Дата добавления записи',
            'customer_id' => 'Заказчик',
            'date' => 'Дата',
            'sum' => 'Сумма, руб.',
        ];
    }

    public static function getTotal($provider, $fieldName)
    {
        $total = 0;

        foreach ($provider as $item) {
            $total += $item[$fieldName];
        }

        return 'Сумма: '.$total;
    }
}
