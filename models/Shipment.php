<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Shipment extends ActiveRecord
{
    public $oneboxweight=0.1;//вес одной коробки в кг
    public $onelabelweight=0.01;//вес одной коробки в кг
    public function getShipmentOrder(){
        return $this->hasMany(ShipmentOrder::class,['shipment_id'=>'id']);
    }
    public function getOrder(){
        return $this->hasMany(Order::class,['id'=>'order_id'])->via('shipmentOrder');
    }
    public function getManagerFullName(){
        $user=User::findByUserName($this->manager_login);
        return $user->F. ' '.mb_substr($user->I,0,1).'.';
    }
    public function getLabel(){
        return $this->hasMany(Label::class,['id'=>'label_id'])->via('order');
    }

    public function getCustomer(){
        return $this->hasMany(Customer::class,['id'=>'customer_id'])->via('label');
    }

    public function getCustomerOrderList(){
        if(!empty($this->customer))
        foreach ($this->customer as $c){
            $orders=Order::find()->joinWith(['label','shipmentOrder'])->select('order.id')->where(['label.customer_id'=>$c->id,'shipment_id'=>$this->id])->column();
            if(!empty($orders))
            foreach($orders as $order){
                ArrayHelper::setValue($CustomerOrderList,[$c->id,$order],$order);
            }

        }
        return $CustomerOrderList;
    }

    public function getRouteList(){
        foreach ($this->customer as $c) $routeList[]=$c->customerAddress;
        return $routeList;
    }
    public function getTownList(){
        $townList=array();
        foreach ($this->customer as $c) {
            $town=Town::findOne($c->town_id)->name;
            if(!ArrayHelper::isIn($town, $townList))
                $townList[]=$town;
        }
        return $townList;
    }

    public function getFinishedProductsWarehouse(){
        return $this->hasMany(FinishedProductsWarehouse::class,['order_id'=>'id'])->via('order');
    }

    public function getShipmentWeight(){
        foreach ($this->finishedProductsWarehouse as $f){
            $weight+=$f->sended_roll_count*$f->label_in_roll*$this->onelabelweight;
            $weight+=$f->sended_box_count*$this->oneboxweight;
        }
        return $weight;
    }

    public function getBoxBaleCount(){
        foreach ($this->finishedProductsWarehouse as $roll){
            $sended_box_count+=$roll->sended_box_count;
            $sended_bale_count+=$roll->sended_bale_count;
        }
        return 'Кор:'.$sended_box_count.' Тюков:'.$sended_bale_count;
    }

    public function getReadyToSend(){
        foreach ($this->order as $order){
            if ($order->status_id !=8) {
                return false;
            }else {
                return true;
            }
        }
    }

    public function attributeLabels(){
        return[
            'id'=>'ID',
            'date_of_send'=>'Дата отправки',
            'date_of_create'=>'Дата создания',
            'managerFullName'=>'Менеджер',
            'manager_login'=>'Менеджер',
        ];
    }

    public function rules(){
        return[
            [['date_of_send'],'required'],
        ];
    }

}