<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

class Label extends ActiveRecord{
	public function getOrder(){
		return $this->hasMany(Order::class,['label_id'=>'id']);
	}
	public function getForm(){
	    if (!empty($this->combination))
            return $this->hasMany(Form::class,['label_id'=>'id'])->via('combination');
		return $this->hasMany(Form::class,['label_id'=>'id']);
	}
    public function getFormCount(){
	    if (count($this->form)==0) return count($this->combinatedForm);
	    else
	    return count($this->form);
    }
	public function getPantone(){
		return $this->hasMany(Pantone::class,['id'=>'pantone_id'])->via('form');
	}
	public function getPantoneCombinated(){
		return $this->hasMany(Pantone::class,['id'=>'pantone_id'])->via('combinatedForm');
	}

    public function getPantoneName(){
        if (count($this->pantone)==0)
            return $this->pantoneCombinated;
        else
            return $this->pantone;
    }

	public function getCombinatedForm(){
		return $this->hasMany(Form::class,['combination_id'=>'combination_id'])->via('combination');
	}
	public function getCombination(){
		return $this->hasOne(CombinationForm::class,['label_id'=>'id']);
	}
	public function getCombinatedLabel(){
	    return ArrayHelper::map(CombinationForm::find()->where(['combination_id'=>$this->combination->combination_id])->all(),'label_id','label_id');
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
    public function getFullCMYK(){
	    if($this->c==1) $c=$this->getAttributeLabel('c');
	    if($this->m==1) $m=$this->getAttributeLabel('m');
	    if($this->y==1) $y=$this->getAttributeLabel('y');
	    if($this->k==1) $k=$this->getAttributeLabel('k');
        return $c.$m.$y.$k;

    }

    public function getLaminateName(){
        if($this->laminate==0) return 'Нет'; else return 'Да';
    }
    public function getVariableName(){
        if($this->variable==0) return 'Нет'; else return 'Да';
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
            'varnishStatusName'=>'Вид лака',
            'varnish_id'=>'Вид лака',
            'pantsName'=>'Штанец',
            'shaft_id'=>'Вал',
            'customerName'=>'Заказчик',
            'customer_id'=>'Заказчик',
            'fullName'=>'Дизайнер',
            'designer_login'=>'Дизайнер',
            'manager_login'=>'Менеджер',
            'shaftName'=>'Вал',
            'fullCMYK'=>'CMYK',
            'manager_note'=>'Примечание от менеджера',
            'prepress_note'=>'Примечание от препрессника',
            'designer_note'=>'Примечание от дизайнера',
            'laboratory_note'=>'Примечание от лаборанта',
            'stencil'=>'Трафарет',
            'laminateName'=>'Ламинация',
            'laminate'=>'Ламинация',
            'backgroundName'=>'Фон',
            'background_id'=>'Фон',
            'managerName'=>'Менеджер',
            'parent_label'=>'С внесением изменений в этикетку',
            'photo_output_id'=>'Фотовывод',
            'color_count'=>'Цветность',
            'orientation'=>'Ориентация',
            'takeoff_flash'=>'Снимать облои',
            'variable_paint_count'=>'Краска переменной печати, мл',
        ];
    }
    public function rules(){
        return[
            ['name','string','max'=>100],
            [['name','manager_note','prepress_note','designer_note','laboratory_note'],'trim'],
            [['variable_paint_count'],'double'],
            [['status_id','name','customer_id','pants_id','laminate','stencil','variable','varnish_id','parent_label',
                'print_on_glue','orientation', 'output_label_id','background_id','image','image_crop','color_count','prepress_design_file','foil_id','takeoff_flash','variable_paint_count'],'safe']
        ];
    }
}