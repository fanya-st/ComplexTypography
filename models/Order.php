<?php

namespace app\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord{
    public $label_status_id;
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
	public function getLabelStatusName(){
		return $this->label->LabelStatusName;
	}
	public function getLabelName(){
		return $this->label->name;
	}
    public function getLabelNameSplitOrderId(){
        return "[$this->id] $this->labelName";
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
    public function getOrderStatusName(){
        return $this->orderStatus->name;
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
    public function getFullName(){
        $user=User::findByUserName($this->label->customer->manager_login);
        return $user->F. ' '.mb_substr($user->I,0,1).'.';
    }
    public function getPrinterName(){
        $user=User::findByUserName($this->printer_login);
        return $user->F. ' '.mb_substr($user->I,0,1).'.';
    }
    public function getCutterName(){
        $user=User::findByUserName($this->cutter_login);
        return $user->F. ' '.mb_substr($user->I,0,1).'.';
    }
    public function getRewinderName(){
        $user=User::findByUserName($this->rewinder_login);
        return $user->F. ' '.mb_substr($user->I,0,1).'.';
    }
    public function getPackerName(){
        $user=User::findByUserName($this->packer_login);
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
            'status_id'=>'Статус заказа',
            'orderStatusName'=>'Статус заказа',
            'labelStatusName'=>'Статус этикетки',
            'label_status_id'=>'Статус этикетки',
            'labelName'=>'Наименование',
            'label_id'=>'ID Этикетки',
            'label.name'=>'Наименование этикетки',
            'date_of_sale'=>'Дата продажи',
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
    public function rules(){
        return[
            [['actual_circulation'],'safe'],
        ];
    }
}