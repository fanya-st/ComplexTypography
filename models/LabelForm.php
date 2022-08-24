<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class LabelForm extends ActiveRecord
{

    public static function tableName()
    {
        return 'label';
    }
    public function attributeLabels(){
        return[
            'name'=>'Наименование этикетки',
            'customer_id'=>'Заказчик',
            'pants_id'=>'Штанец',
            'orientation'=>'Ориентация',
            'output_label_id'=>'Выход этикетки',
            'laminate'=>'Ламинация',
            'variable'=>'Переменная печать',
            'varnish_id'=>'Вид лака',
            'print_on_glue'=>'Печать по клею',
            'background_id'=>'Фон',
            'manager_note'=>'Примечание от менеджера',
            'prepress_note'=>'Примечание от препрессника',
            'designer_note'=>'Примечание от дизайнера',
            'laboratory_note'=>'Примечание от лаборанта',
            'stencil'=>'Трафарет',
            'shaft_id'=>'Вал',
            'foil_width'=>'Ширина фольги, мм',
            'parent_label'=>'Внести изменения в этикетку',
            'image_file'=>'Картинка этикетки',
            'image_crop_file'=>'Картинка этикетки (кропнутая)',
            'image_extended_file'=>'Доп картинка',
            'design_file_file'=>'Файл дизайна',
            'foil_id'=>'Фольга',
            'color_count'=>'Цветность',
            'takeoff_flash'=>'Снимать облои',
            'variable_paint_count'=>'Краска переменной печати, мл',
        ];
    }
    public function rules(){
        return[
            [['name','image','image_crop','image_extended','design_file','prepress_design_file'],'string','max'=>100],
            [['designer_login','prepress_login','laboratory_login'],'string','max'=>50],
            [['manager_note','prepress_note','designer_note','laboratory_note','name','image','image_crop','image_extended','design_file','prepress_design_file',
                'designer_login','prepress_login','laboratory_login'],'trim'],
            [['variable_paint_count'],'number'],
            [['name','status_id','customer_id'],'required'],
            [['date_of_create','date_of_design','date_of_prepress','date_of_flexformready'],'safe'],
            [['status_id','customer_id','pants_id','laminate','stencil','variable','varnish_id','parent_label',
                'print_on_glue','orientation', 'output_label_id','background_id','color_count','foil_id','takeoff_flash'],'integer'],
        ];
    }

    public function beforeValidate()
    {
        //Проверяем если нет статуса, то ставим статус "Новый"
        if (empty($this->status_id)) {
            $this->status_id = 1;
        }
        return parent::beforeValidate();
    }

    public function createSame(){
        $this->setIsNewRecord(true);
        $this->parent_label=$this->id;
        $this->status_id=1;
        unset($this->id);
        unset($this->date_of_create);
        unset($this->date_of_prepress);
        unset($this->date_of_design);
        unset($this->prepress_login);
        unset($this->laboratory_login);
        unset($this->date_of_flexformready);
    }
}