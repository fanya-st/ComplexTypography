<?php


namespace app\models;


use yii\db\ActiveRecord;

class DesignFileForm extends ActiveRecord
{
    public $design_file_file;
    public $image_file;
    public $image_crop_file;
    public $image_extended_file;

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
            [['designer_note'],'trim'],
            [['image_extended_file'], 'image','skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg','mimeTypes'=>'image/*', 'maxSize'=>15*1024*1024],
            [['image_file','image_crop_file'], 'image','skipOnEmpty' => false,'mimeTypes'=>'image/*', 'extensions' => 'png,jpg,jpeg','maxSize'=>15*1024*1024],
            [['design_file_file'], 'file','skipOnEmpty' => false,'maxSize'=>128*1024*1024,'checkExtensionByMimeType'=>false],
        ];
    }

    public function upload($label): bool
    {
        if ($this->validate()) {
            if ($this->image_file && $this->image_file->tempName) {
                $this->image_file->saveAs('label/' . $this->id . '.' . $this->image_file->extension);
                $label->image = 'label/' . $this->id . '.' . $this->image_file->extension;
            }
            if ($this->image_crop_file && $this->image_crop_file->tempName) {
                $this->image_crop_file->saveAs('label/' . $this->id . '_crop.' . $this->image_crop_file->extension);
                $label->image_crop = 'label/' . $this->id . '_crop.' . $this->image_crop_file->extension;
            }
            if ($this->image_extended_file && $this->image_extended_file->tempName) {
                $this->image_extended_file->saveAs('label/' . $this->id . '_extended.' . $this->image_extended_file->extension);
                $label->image_extended = 'label/' . $this->id . '_extended.' . $this->image_extended_file->extension;
            }

            if ($this->design_file_file && $this->design_file_file->tempName) {
                $this->design_file_file->saveAs('label/' . $this->id . '_design.' . $this->design_file_file->extension);
                $label->design_file = 'label/' . $this->id . '_design.' . $this->design_file_file->extension;
            }
            return true;
        } else {
            return false;
        }
    }

}