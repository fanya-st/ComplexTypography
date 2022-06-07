<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class PrepressFileForm extends ActiveRecord
{
    public $prepress_design_file_file;

    public static function tableName()
    {
        return 'label';
    }

    public function attributeLabels(){
        return[
            'prepress_design_file_file'=>'Файл Prepress',
            'name'=>'Наименование этикетки',
            'customer_id'=>'Заказчик',
            'pants_id'=>'Штанец',
            'orientation'=>'Ориентация',
            'output_label_id'=>'Выход этикетки',
            'laminate'=>'Ламинация',
            'variable'=>'Переменная печать',
            'embossing'=>'Тиснение',
            'varnish_id'=>'Вид лака',
            'print_on_glue'=>'Печать по клею',
            'background_id'=>'Фон',
            'manager_note'=>'Примечание для дизайнеров и препрессников',
            'prepress_note'=>'Примечание для лаборатории и печатников',
            'designer_note'=>'Примечание для препрессников',
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

        ];
    }

    public function rules(){
        return[
//            [[],'trim'],
//            [[],'safe'],
            [['prepress_design_file_file'], 'file','skipOnEmpty' => false,'maxSize'=>500*1024*1024],
        ];
    }

    public function upload($label)
    {
        if ($this->validate()) {
            if ($this->prepress_design_file_file && $this->prepress_design_file_file->tempName) {
                $this->prepress_design_file_file->saveAs('label/' . $this->id . '_prepress.' . $this->prepress_design_file_file->extension);
                $label->prepress_design_file = 'label/' . $label->id . '_prepress.' . $this->prepress_design_file_file->extension;
            }
            return true;
        } else {
            return false;
        }
    }

}