<?php

namespace app\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord{
    public $label_status_id;
	public function getLabel(){
		return $this->hasOne(Label::class,['id'=>'label_id']);
	}
	public function getCustomer(){
		return $this->hasOne(Customer::class,['id'=>'customer_id'])->via('label');
	}
	public function getLabelStatusName(){
		return $this->label->LabelStatusName;
	}
	public function getLabelName(){
		return $this->label->name;
	}

    public function getOrderStatus(){
        return $this->hasOne(OrderStatus::class,['id'=>'status_id']);
    }
    public function getOrderStatusName(){
        return $this->orderStatus->name;
    }
    public function getMashine(){
        return $this->hasOne(Mashine::class,['id'=>'mashine_id']);
    }
    public function getFullName(){
        $user=User::findByUserName($this->label->customer->manager_login);
        return $user->F. ' '.mb_substr($user->I,0,1).'.';
    }
    public function getCustomerId(){
        return $this->label->customer_id;
    }

    public function getPants(){
        return $this->hasOne(Pants::class,['id'=>'pants_id'])->via('label');
    }

    public function getShaft(){
        return $this->hasOne(Shaft::class,['id'=>'shaft_id'])->via('pants');
    }

    public function getMashineName(){
        return $this->mashine->name;
    }
    public function attributeLabels()
    {
        return [
            'id'=>'ID Заказа',
            'name'=>'Наименование',
            'date_of_create'=>'Дата создания',
            'status_id'=>'Статус заказа',
            'orderStatusName'=>'Статус заказа',
            'labelStatusName'=>'Статус этикетки',
            'label_status_id'=>'Статус этикетки',
            'labelName'=>'Наименование',
            'label_id'=>'ID Этикетки',
            'label.name'=>'Наименование этикетки',
            'date_of_sale'=>'Дата продажи',
            'date_of_packing'=>'Дата упаковки',
            'date_of_rewind'=>'Дата перемотки',
            'mashine_id'=>'Станок',
            'mashineName'=>'Станок',
            'plan_circulation'=>'Плановый тираж',
            'actual_circulation'=>'Фактический тираж',
            'material_id'=>'Материал',
            'printer'=>'Печатник',
            'fullName'=>'Менеджер',
            'manager_login'=>'Менеджер',
            'customerId'=>'Заказчик',
            'pantsId'=>'Штанец',
            'shaft_id'=>'Вал',
        ];
    }
}