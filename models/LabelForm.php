<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\bootstrap4\Html;

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
            'embossing'=>'Тиснение',
            'varnish_id'=>'Вид лака',
            'print_on_glue'=>'Печать по клею',
            'background_id'=>'Фон',
            'manager_note'=>'Примечание для дизайнеров и препрессников',
            'stencil'=>'Трафарет',
        ];
    }
    public function rules(){
        return[
            [['name','customer_id','pants_id','laminate','stencil','variable','varnish_id','print_on_glue','background_id','orientation','embossing','manager_login','output_label_id'],'required'],
            ['name','string','max'=>100],
            [['name','manager_note'],'trim']
        ];
    }

}