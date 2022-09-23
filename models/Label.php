<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

class Label extends ActiveRecord{
    public static function tableName()
    {
        return 'label';
    }

    public function getOrder()
    {
		return $this->hasMany(Order::class,['label_id'=>'id']);
	}
	public function getForm()
    {
	    if (!empty($this->combination))
            return $this->hasMany(Form::class,['label_id'=>'id'])->via('combination');
		return $this->hasMany(Form::class,['label_id'=>'id']);
	}
    public function getFormCount()
    {
	    if (count($this->form)==0) return count($this->combinatedForm);
	    else
	    return count($this->form);
    }
	public function getPantone()
    {
		return $this->hasMany(Pantone::class,['id'=>'pantone_id'])->via('form');
	}
	public function getPantoneCombinated()
    {
		return $this->hasMany(Pantone::class,['id'=>'pantone_id'])->via('combinatedForm');
	}

    public function getPantoneName(){
        if (count($this->pantone)==0)
            return $this->pantoneCombinated;
        else
            return $this->pantone;
    }

	public function getCombinatedForm()
    {
		return $this->hasMany(Form::class,['combination_id'=>'combination_id'])->via('combination');
	}
	public function getCombination()
    {
		return $this->hasOne(CombinationForm::class,['label_id'=>'id']);
	}
	public function getCombinatedLabel()
    {
        if (!empty($this->combination)) {
            return ArrayHelper::map(CombinationForm::find()->where(['combination_id'=>$this->combination->combination_id])->all(),'label_id','label_id');
        }
	}
    public function getVarnishStatus()
    {
        return $this->hasOne(VarnishStatus::class,['id'=>'varnish_id']);
    }
    public function getBackgroundLabel()
    {
        return $this->hasOne(BackgroundLabel::class,['id'=>'background_id']);
    }
    public function getOutputLabel()
    {
        return $this->hasOne(OutputLabel::class,['id'=>'output_label_id']);
    }
    public function getFoil()
    {
        return $this->hasOne(Foil::class,['id'=>'foil_id']);
    }
    public function getCustomer()
    {
        return $this->hasOne(Customer::class,['id'=>'customer_id']);
    }
    public function getLabelStatus()
    {
        return LabelStatus::$label_status[$this->status_id];
    }
    public function getPants()
    {
        return $this->hasOne(Pants::class,['id'=>'pants_id']);
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
    public function getNameSplitId(): string
    {
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
            'designer_id'=>'Дизайнер',
            'manager_id'=>'Менеджер',
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
    public function rules()
    {
        return[
            [['name','image','image_crop','image_extended','design_file','prepress_design_file'],'string','max'=>100],
            [['manager_note','prepress_note','designer_note','laboratory_note','name','image','image_crop','image_extended','design_file','prepress_design_file'],'trim'],
            [['variable_paint_count'],'number'],
            [['name','status_id','customer_id'],'required'],
            [['date_of_create','date_of_design','date_of_prepress','date_of_flexformready','combinated_label_list'],'safe'],
            [['status_id','customer_id','pants_id','laminate','stencil','variable','varnish_id','parent_label',
                'print_on_glue','orientation', 'output_label_id','background_id','color_count','foil_id','takeoff_flash','designer_id','laboratory_id','prepress_id'],'integer'],
        ];
    }

//    public function beforeValidate()
//    {
//        //Проверяем если нет статуса, то ставим статус "Новый"
//        if (empty($this->status_id)) {
//            $this->status_id = 1;
//        }
//        return parent::beforeValidate();
//    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
            if ($insert) {
                Yii::info("Создана этикетка пользователем ".Yii::$app->user->identity->username.' №'.$this->id);
                Yii::$app->session->setFlash('success', 'Этикетка создана !');
            } else {
                Yii::$app->session->setFlash('success', 'Этикетка обновлена!');
            }
    }

    public function createSubLabel() {
	    $sub_label=$this;
        $sub_label->parent_label=$this->id;
        $sub_label->status_id=1;
        unset($sub_label->id);
        unset($sub_label->date_of_create);
        unset($sub_label->date_of_prepress);
        unset($sub_label->date_of_design);
        unset($sub_label->prepress_id);
        unset($sub_label->laboratory_id);
        unset($sub_label->date_of_flexformready);
        $sub_label->setisNewRecord(true);
        $sub_label->save();
        return $sub_label->id;
    }

    public function decombinateLabel() {
        foreach (CombinationForm::find()->where(['label_id'=>$this->id])->all() as $combination){
            $combination->delete();
        }
    }

    public object $combinated_label_list;

    public function combinateLabel(): bool
    {
        $new_combination= new Combination();
        if($new_combination->save()){
            if(!empty($this->combinated_label_list)){
                foreach($this->combinated_label_list as $label_id){
                    $temp=new CombinationForm();
                    $temp->combination_id=$new_combination->id;
                    $temp->label_id=$label_id;
                    $temp->save();
                }
                $temp=new CombinationForm();
                $temp->combination_id=$new_combination->id;
                $temp->label_id=$this->id;
                if ($temp->save())
                    return true;
            } else{
                return false;
            }
        }
    }
}