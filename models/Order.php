<?php

namespace app\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord{

	public function getLabel(){
		return $this->hasOne(Label::class,['id'=>'label_id']);
	}
	public function getShipmentOrder(){
		return $this->hasOne(ShipmentOrder::class,['order_id'=>'id']);
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

    public function getCombinationOrder(){
        return $this->hasOne(CombinationOrder::class,['order_id'=>'id']);
    }

	public function getCombinatedPrintOrder(){
        return $this->hasMany(CombinationOrder::class,['combination_id'=>'combination_id'])->via('combinationOrder');
	}
	public function getFinishedProductsWarehouse(){
        return $this->hasMany(FinishedProductsWarehouse::class,['order_id'=>'id']);
	}
	public function getOrderMaterialList(){
        return $this->hasMany(OrderMaterial::class,['order_id'=>'id']);
	}
	public function getCombinatedPrintOrderName(){
	    $name='совместная печать: ';
        foreach ($this->combinatedPrintOrder as $com_ord) $name.='['.$com_ord->order_id.'],';
        return $name;
	}

    public function getOrderStatus(){
        return $this->hasOne(OrderStatus::class,['id'=>'status_id']);
    }

    public function getTrialCirculationName(){
	    switch($this->trial_circulation){
            case 0:
                return 'Нет';
                break;
            case 1:
                return 'Да';
                break;
        }
        return $this->orderStatus->name;
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
            'orderStatusName'=>'Статус заказа',
            'labelStatusName'=>'Статус этикетки',
            'labelName'=>'Наименование',
            'label_id'=>'ID Этикетки',
            'label.name'=>'Наименование этикетки',
            'date_of_sale'=>'Дата продажи',
            'mashine_id'=>'Станок',
            'mashineName'=>'Станок',
            'plan_circulation'=>'Плановый тираж',
            'actual_circulation'=>'Фактический тираж',
            'trial_circulation'=>'Пробный тираж',
            'label_price'=>'Цена этикетки',
            'order_price'=>'Цена заказа',
            'label_price_with_tax'=>'Цена этикетки с НДС',
            'order_price_with_tax'=>'Цена заказа с НДС',
            'pants_price'=>'Цена штанца',
            'delivery_price'=>'Цена доставки',
            'material_id'=>'Материал',
            'printer'=>'Печатник',
            'fullName'=>'Менеджер',
            'sending'=>'Отправка',
            'manager_login'=>'Менеджер',
            'printer_login'=>'Печатник',
            'rewinder_login'=>'Перемотчик',
            'rewinder_note'=>'Примечание перемотчика',
            'printer_note'=>'Примечание печатника',
            'tech_note'=>'Примечание технолога',
            'manager_note'=>'Примечание менеджера',
            'packer_login'=>'Упаковщик',
            'customerId'=>'Заказчик',
            'pantsId'=>'Штанец',
            'shaft_id'=>'Вал',
            'stretch'=>'Стретч лента',
            'label_on_roll'=>'Этикеток на ролике',
            'winding_id'=>'Намотка',
            'sleeve_id'=>'Втулка',
            'diameter_roll'=>'Диаметр ролика',
            'cut_edge'=>'Обрезать кромки',
        ];
    }
    public function rules(){
        return[
            [['id','status_id','label_id','stretch','cut_edge','label_on_roll','diameter_roll','winding_id',
                'sleeve_id','actual_circulation','trial_circulation','sending','material_id'],'integer'],
            [['tech_note','tech_note','printer_note','rewinder_note','packer_login','rewinder_login'],'trim'],
            [['label_price_with_tax','label_price'],'double'],
            [['date_of_sale','date_of_create','date_of_variable_print_begin','date_of_packing_begin','date_of_rewind_begin','date_of_print_end','date_of_variable_print_end','date_of_rewind_end','date_of_packing_end'],'safe'],
        ];
    }
}