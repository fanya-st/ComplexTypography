<?php


namespace app\models;


use yii\db\ActiveRecord;

class ShipmentOrder extends ActiveRecord
{
    public static function tableName()
    {
        return 'shipment_order';
    }

    public function attributeLabels()
    {
        return [
            'order_id'=>'Станок',
            'shipment_id'=>'Отгрузка',
        ];
    }

    public function rules(){
        return[
            [['order_id','shipment_id'],'integer'],
            [['order_id','shipment_id'],'required'],
            [['order_id'], 'unique'],
        ];
    }
}