<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii;

class Order extends ActiveRecord{

	public function getLabel(){
		return $this->hasOne(Label::class,['id'=>'label_id']);
	}
	public function getShipmentOrder(){
		return $this->hasOne(ShipmentOrder::class,['order_id'=>'id']);
	}

	public function getShipment(){
		return $this->hasOne(Shipment::class,['id'=>'shipment_id'])->via('shipmentOrder');
	}


	public function getSleeve(){
		return $this->hasOne(Sleeve::class,['id'=>'sleeve_id']);
	}
	public function getWinding(){
		return $this->hasOne(Winding::class,['id'=>'winding_id']);
	}
	public function getCustomer(){
		return $this->hasOne(Customer::class,['id'=>'customer_id'])->via('label');
	}
    public function getLabelNameSplitOrderId(){
        return '['.$this->id.']'.$this->label->name;
    }

	public function getFinishedProductsWarehouse(){
        return $this->hasMany(FinishedProductsWarehouse::class,['order_id'=>'id']);
	}
	public function getOrderMaterialList(){
        return $this->hasMany(OrderMaterial::class,['order_id'=>'id']);
	}

	public function getFormOrderHistory(){
        return $this->hasMany(FormOrderHistory::class,['order_id'=>'id']);
	}

	public function getCombinatedPrintOrder(){
        return Order::find()->where(['label_id'=>$this->label->combinatedLabel])->all();
	}

    public function getOrderStatus(){
        return OrderStatus::$order_status[$this->status_id];
    }

    public function getMashine(){
        return $this->hasOne(Mashine::class,['id'=>'mashine_id']);
    }
    public function getMaterial(){
        return $this->hasOne(Material::class,['id'=>'material_id']);
    }

    public function getPants(){
        return $this->hasOne(Pants::class,['id'=>'pants_id'])->via('label');
    }

    public function getShaft(){
        return $this->hasOne(Shaft::class,['id'=>'shaft_id'])->via('pants');
    }

    public function getCirculationCountSend(){
	    foreach($this->finishedProductsWarehouse as $roll)
	        $count+=$roll->sended_roll_count*$roll->label_in_roll;
        return $count;
    }

    public function getActualCirculation(){
        foreach(FinishedProductsWarehouse::find()->select(['label_in_roll','roll_count'])->where(['order_id'=>$this->id])->all() as $roll){
            $actual_circulation+=$roll->label_in_roll*$roll->roll_count;
        }
        return $actual_circulation;
    }



    public function attributeLabels()
    {
        return [
            'id'=>'ID Заказа',
            'name'=>'Наименование',
            'date_of_create'=>'Дата создания',
            'date_of_print_begin'=>'Дата начала печати',
            'date_of_print_end'=>'Дата окончания печани',
            'date_of_packing_begin'=>'Дата начала упаковки',
            'date_of_packing_end'=>'Дата окончания упаковки',
            'date_of_rewind_begin'=>'Дата начала перемотки',
            'date_of_rewind_end'=>'Дата окончания перемотки',
            'status_id'=>'Статус заказа',
            'label_id'=>'Этикетка',
            'date_of_sale'=>'Дата продажи',
            'mashine_id'=>'Станок',
            'plan_circulation'=>'Плановый тираж, шт',
            'printed_circulation'=>'Тираж по печати, шт',
            'label_price'=>'Цена этикетки, руб',
            'label_price_with_tax'=>'Цена этикетки с НДС, руб',
            'material_id'=>'Материал',
            'sending'=>'Отправка, шт',
            'manager_id'=>'Менеджер',
            'printer_id'=>'Печатник',
            'rewinder_id'=>'Перемотчик',
            'rewinder_note'=>'Примечание перемотчика',
            'printer_note'=>'Примечание печатника',
            'tech_note'=>'Примечание технолога',
            'manager_note'=>'Примечание менеджера',
            'packer_id'=>'Упаковщик',
            'pants_id'=>'Штанец',
            'stretch'=>'Стретч лента',
            'label_on_roll'=>'Этикеток на ролике, шт',
            'winding_id'=>'Намотка',
            'sleeve_id'=>'Втулка, мм',
            'cut_edge'=>'Обрезать кромки',
        ];
    }
    public function rules(){
        return[
            [['status_id','label_id','stretch','cut_edge','label_on_roll','winding_id',
                'sleeve_id','sending','material_id','mashine_id','printed_circulation','packer_id','rewinder_id','printer_id'],'integer'],
            [['tech_note','printer_note','rewinder_note','manager_note'],'trim'],
            [['label_price_with_tax','label_price'],'number'],
            [['plan_circulation','sending','label_price_with_tax','label_price','stretch','cut_edge','sleeve_id',
                'material_id','mashine_id','date_of_sale','winding_id','label_on_roll'],'required'],
            [['date_of_sale','date_of_create','date_of_variable_print_begin','date_of_packing_begin','date_of_rewind_begin',
                'date_of_print_end','date_of_variable_print_end','date_of_rewind_end','date_of_packing_end'],'safe'],
        ];
    }

    public function beforeDelete()
    {
        if (!empty($this->orderMaterialList)) {
            Yii::$app->session->setFlash('error','Заказ не может быть удален, на нем есть расход материала');
            return false;
        }
        if (!empty($this->shipmentOrder)) {
            Yii::$app->session->setFlash('error','Заказ не может быть удален, он находиться в отправке');
            return false;
        }
        Yii::info("Заказ №".$this->id." удален пользователем ".Yii::$app->user->identity->getId());
        return parent::beforeDelete();
    }

    public function afterSave($insert, $changedAttributes) {
        if ($insert) {
            Yii::info("Создана заказ пользователем ".Yii::$app->user->identity->getId().' №'.$this->id);
            Yii::$app->session->setFlash('success', 'Заказ добавлен');
        } else {
            Yii::$app->session->setFlash('success', 'Запись обновлена');
        }
        parent::afterSave($insert, $changedAttributes);
    }
}