<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class LabelForm extends ActiveRecord
{
    public $design_file_file;
    public $image_file;
    public $image_crop_file;
    public $image_extended_file;
    public $prepress_pantone_list;
    public $subdpi;
    public $varnish_check;
    public $stencil_check;
    public $prepress_file;
    public $set_form_count;
    public $form_width;
    public $form_height;
    public $lineature=154;

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
            'embossing'=>'Тиснение',
            'varnish_id'=>'Вид лака',
            'print_on_glue'=>'Печать по клею',
            'background_id'=>'Фон',
            'manager_note'=>'Примечание для дизайнеров и препрессников',
            'prepress_note'=>'Примечание для лаборатории и печатников',
            'designer_note'=>'Примечание для препрессников',
            'stencil'=>'Трафарет',
            'shaft_id'=>'Вал',
            'parent_label'=>'Внести изменения в этикетку',
            'image_file'=>'Картинка этикетки',
            'image_crop_file'=>'Картинка этикетки (кропнутая)',
            'image_extended_file'=>'Доп картинка',
            'design_file_file'=>'Файл дизайна',
            'prepress_file'=>'Файл Prepress',
            'prepress_pantone_list'=>'CMYK и пантоны',
            'photo_output_id'=>'Фотовывод',
            'subdpi'=>'Разрешение фотовывода',
            'varnish_check'=>'Лаковая форма',
            'form_width'=>'Ширина формы, мм',
            'form_height'=>'Высота формы, мм',
            'set_form_count'=>'Количество комплектов форм',
            'foil_id'=>'Фольга',
            'lineature'=>'Линиатура',
            'stencil_check'=>'Трафарет',
        ];
    }
    public function rules(){
        return[
            [['name','customer_id','pants_id','laminate','stencil','variable','varnish_id',
                'print_on_glue','background_id','orientation','embossing',
                'manager_login','output_label_id'],'required'],
            ['name','string','max'=>100],
            [['name','manager_note','designer_note'],'trim'],
            [['parent_label','status_id','image','image_crop','image_extended','design_file','date_of_design','prepress_pantone_list','varnish_check','subdpi',
                'stencil_check','set_form_count','lineature','form_height','form_width','shaft_id'],'safe'],
            [['image_file','image_crop_file','image_extended_file'], 'image','skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg','maxSize'=>10*1024*1024],
            [['design_file_file','prepress_file'], 'file','skipOnEmpty' => true,'maxSize'=>500*1024*1024],
//            [['lineature'], 'default', 'value'=> 154]
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            if ($this->image_file && $this->image_file->tempName) {
                $this->image_file->saveAs('label/' . $this->id . '.' . $this->image_file->extension);
                $this->image = 'label/' . $this->id . '.' . $this->image_file->extension;
                $this->image_file = null;
            }
            if ($this->image_crop_file && $this->image_crop_file->tempName) {
                $this->image_crop_file->saveAs('label/' . $this->id . '_crop.' . $this->image_crop_file->extension);
                $this->image_crop = 'label/' . $this->id . '_crop.' . $this->image_crop_file->extension;
                $this->image_crop_file = null;
            }
        if ($this->image_extended_file && $this->image_extended_file->tempName) {
            $this->image_extended_file->saveAs('label/' . $this->id . '_extended.' . $this->image_extended_file->extension);
            $this->image_extended = 'label/' . $this->id . '_extended.' . $this->image_extended_file->extension;
            $this->image_extended_file = null;
        }

        if ($this->design_file_file && $this->design_file_file->tempName) {
            $this->design_file_file->saveAs('label/' . $this->id . '_design.' . $this->design_file_file->extension);
            $this->design_file = 'label/' . $this->id . '_design.' . $this->design_file_file->extension;
            $this->design_file_file = null;
        }
            return true;
        } else {
            return false;
        }
    }
}