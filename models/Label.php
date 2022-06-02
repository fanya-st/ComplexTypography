<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Label extends ActiveRecord{	
	public function getOrder(){
		return $this->hasMany(Order::class,['label_id'=>'id']);
	}
	public function getForm(){
		return $this->hasMany(Form::class,['label_id'=>'id']);
	}
    public function getFormCount(){
	    print_r(count($this->form));
    }
	public function getPantone(){
		return $this->hasMany(Pantone::class,['id'=>'pantone_id'])->viaTable('pantone_label',['label_id'=>'id']);
	}
    public function getVarnishStatus(){
        return $this->hasOne(VarnishStatus::class,['id'=>'varnish_id']);
    }
    public function getBackgroundLabel(){
        return $this->hasOne(BackgroundLabel::class,['id'=>'background_id']);
    }
    public function getOutputLabel(){
        return $this->hasOne(OutputLabel::class,['id'=>'output_label_id']);
    }
    public function getShaft(){
        return $this->hasOne(Shaft::class,['id'=>'shaft_id']);
    }
    public function getFoil(){
        return $this->hasOne(Foil::class,['id'=>'foil_id']);
    }
    public function getCustomer(){
        return $this->hasOne(Customer::class,['id'=>'customer_id']);
    }
    public function getLabelStatus(){
        return $this->hasOne(LabelStatus::class,['id'=>'status_id']);
    }
    public function getPants(){
        return $this->hasOne(Pants::class,['id'=>'pants_id']);
    }
    public function getPantsName(){
        return $this->pants->name;
    }
    public function getShaftName(){
        return $this->shaft->name;
    }
    public function getFullCMYK(){
	    if($this->c==1) $c=$this->getAttributeLabel('c');
	    if($this->m==1) $m=$this->getAttributeLabel('m');
	    if($this->y==1) $y=$this->getAttributeLabel('y');
	    if($this->k==1) $k=$this->getAttributeLabel('k');
        return $c.$m.$y.$k;

    }
    public function getLabelStatusName(){
        return $this->labelStatus->name;
    }
    public function getCustomerName(){
        return $this->customer->name;
    }
    public function getVarnishStatusName(){
        return $this->varnishStatus->name;
    }
    public function getFullName(){
	    $user=User::findByUserName($this->designer_login);
        return $user->F. ' '.mb_substr($user->I,0,1).'.';
    }
    public function getPrepressName(){
        $user=User::findByUserName($this->prepress_login);
        return $user->F. ' '.mb_substr($user->I,0,1).'.';
    }
    public function getManagerName(){
        $user=User::findByUserName($this->manager_login);
        return $user->F. ' '.mb_substr($user->I,0,1).'.';
    }
    public function getFoilName(){
        return $this->foil->name;
    }
    public function getLaminateName(){
        if($this->laminate==0) return 'Нет'; else return 'Да';
    }
    public function getVariableName(){
        if($this->variable==0) return 'Нет'; else return 'Да';
    }
    public function getEmbossingName(){
        if($this->embossing==0) return 'Нет'; else return 'Да';
    }
    public function getOrientationName(){
        if($this->orientation==0) return 'Не указана';
        elseif($this->orientation==1) return 'Альбомная';
        else return 'Книжная';
    }
    public function getStencilName(){
        if($this->stencil==0) return 'Нет'; else return 'Да';
    }
    public function getPrintOnGlueName(){
        if($this->print_on_glue==0) return 'Нет'; else return 'Да';
    }
    public function getBackgroundName(){
        return $this->backgroundLabel->name;
    }
    public function getNameSplitId(){
        return "[$this->id] $this->name";
    }

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'name'=>'Наименование',
            'c'=>'C',
            'm'=>'M',
            'y'=>'Y',
            'k'=>'K',
            'date_of_create'=>'Дата создания',
            'date_of_design'=>'Дата дизайна',
            'date_of_prepress'=>'Дата Prepress',
            'foil'=>'Фольга',
            'foil_id'=>'Фольга',
            'print_on_glue'=>'Печать по клею',
            'variable'=>'Переменная печать',
            'image'=>'Картинка этикетки',
            'image_crop'=>'Превью этикетки',
            'labelStatusName'=>'Статус этикетки',
            'output_label_id'=>'Выход этикетки',
            'status_id'=>'Статус этикетки',
            'pants_id'=>'Штанец',
            'shaft_id'=>'Вал',
            'varnishStatusName'=>'Вид лака',
            'varnish_id'=>'Вид лака',
            'pantsName'=>'Штанец',
            'customerName'=>'Заказчик',
            'customer_id'=>'Заказчик',
            'fullName'=>'Дизайнер',
            'designer_login'=>'Дизайнер',
            'manager_login'=>'Менеджер',
            'shaftName'=>'Вал',
            'fullCMYK'=>'CMYK',
            'designer_note'=>'Примечание дизайнера',
            'prepress_note'=>'Примечание Prepress',
            'stencil'=>'Трафарет',
            'manager_note'=>'Примечание менеджера',
            'laminateName'=>'Ламинация',
            'laminate'=>'Ламинация',
            'backgroundName'=>'Фон',
            'background_id'=>'Фон',
            'managerName'=>'Менеджер',
            'parent_label'=>'С внесением изменений в этикетку',
            'embossing'=>'Тиснение',
            'orientation'=>'Ориентация'
        ];
    }
    public function rules(){
        return[
            ['name','string','max'=>100],
            [['name','manager_note','prepress_note','designer_note'],'trim'],
            [['status_id','name','customer_id','pants_id','laminate','stencil','variable','varnish_id',
                'print_on_glue','orientation','embossing',
                'manager_login','output_label_id','shaft_id','background_id','image','image_crop'],'safe']
        ];
    }
}