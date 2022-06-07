<?php


namespace app\models;


use yii\db\ActiveRecord;

class PrepressForm extends ActiveRecord
{
    public $prepress_pantone_list;
    public $set_form_count;
    public $combination_label;
    public $foil_width;

    public static function tableName()
    {
        return 'form';
    }

    public function attributeLabels(){
        return[
            'prepress_design_file_file'=>'Файл Prepress',
            'prepress_pantone_list'=>'CMYK и пантоны',
            'photo_output_id'=>'Фотовывод',
            'dpi'=>'Разрешение фотовывода',
            'varnish_check'=>'Лаковая форма',
            'width'=>'Ширина формы, мм',
            'height'=>'Высота формы, мм',
            'set_form_count'=>'Количество комплектов форм',
            'lpi'=>'Линиатура (по умолчанию 154)',
            'stencil_check'=>'Трафарет',
            'combination_label'=>'Совмещение',
        ];
    }
    public function rules(){
        return[
            [['prepress_pantone_list','set_form_count','height','width','dpi','photo_output_id','lpi'],'required'],
//            ['name','string','max'=>100],
//            [['prepress_note'],'trim'],
            [['prepress_pantone_list','combination_label'],'safe'],
//            [['image_file','image_crop_file','image_extended_file'], 'image','skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg','maxSize'=>10*1024*1024],
//            [['lpi'], 'default', 'value'=> 154],
        ];
    }
}