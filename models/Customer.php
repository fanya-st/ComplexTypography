<?php


namespace app\models;

use yii\db\ActiveRecord;


class Customer extends ActiveRecord
{

    public function getCustomerStatus(){
        return CustomerStatus::$customer_status[$this->status_id];
    }
    public function getSubject(){
        return $this->hasOne(Subject::class,['id'=>'subject_id']);
    }
    public function getRegion(){
        return $this->hasOne(Region::class,['id'=>'region_id']);
    }
    public function getTown(){
        return $this->hasOne(Town::class,['id'=>'town_id']);
    }
    public function getStreet(){
        return $this->hasOne(Street::class,['id'=>'street_id']);
    }


    public function getLabel(){
        return $this->hasMany(Label::class,['customer_id'=>'id']);
    }

    public function getOrder(){
        return $this->hasMany(Order::class,['label_id'=>'id'])->via('label');
    }

    public function getShipmentOrder(){
        return $this->hasMany(ShipmentOrder::class,['order_id'=>'id'])->via('order');
    }

    public function getCustomerShipmentOrder(int $shipment_id){
        return Order::find()->joinWith(['shipmentOrder','label'])->where(['shipment_order.shipment_id'=>$shipment_id,'label.customer_id'=>$this->id])->column();
    }

    public function getCustomerAddress(){
        return 'РФ, '.$this->subject->name.', '.$this->region->name.', '.$this->town->name.', улица '.$this->street->name.', '.$this->house;
    }

    public function attributeLabels()
    {
        return [
            'name'=>'Заказчик',
            'id'=>'ID',
            'status_id'=>'Статус',
            'email'=>'E-Mail',
            'number'=>'Телефон',
            'house'=>'Дом, строение, квартира',
            'region_id'=>'Область, район',
            'subject_id'=>'Субъект РФ',
            'town_id'=>'Административный центр, город, пгт, деревня',
            'date_of_agreement'=>'Дата договора',
            'street_id'=>'Улица',
            'comment'=>'Комментарий',
            'time_to_delivery_from'=>'Время доставки с',
            'time_to_delivery_to'=>'Время доставки до',
            'contact'=>'Контактное лицо',
            'customerAddress'=>'Адрес',
            'date_of_create'=>'Дата создания',
            'user_id'=>'Менеджер',
            'customerStatus.name'=>'Статус',
        ];
    }

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['status_id','region_id','subject_id','town_id','street_id','user_id'], 'integer'],
            [['name','house'], 'trim'],
            [['name','house'], 'string'],
            [['date_of_agreement'], 'safe'],
        ];
    }
}