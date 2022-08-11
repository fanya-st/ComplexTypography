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
            [['name','customer_id','pants_id','laminate','stencil','variable','varnish_id',
                'print_on_glue','background_id','orientation','foil_id','output_label_id','color_count','takeoff_flash'],'required'],
            ['name','string','max'=>100],
            [['name','manager_note','designer_note'],'trim'],
            [['variable_paint_count'],'double'],
            [['parent_label','status_id','image','image_crop','image_extended','design_file','date_of_design','shaft_id','variable_paint_count'],'safe'],
        ];
    }
}