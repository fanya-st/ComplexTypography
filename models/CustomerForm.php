<?php


namespace app\models;

use yii\db\ActiveRecord;


class CustomerForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'customer';
    }


    public function attributeLabels()
    {
        return [
            'name'=>'Заказчик',
            'id'=>'Заказчик',
            'status_id'=>'Статус',
            'email'=>'E-Mail',
            'number'=>'Телефон',
            'house'=>'Дом, строение, квартира',
            'region_id'=>'Область, район',
            'subject_id'=>'Субъект РФ',
            'town_id'=>'Административный центр, город, пгт, деревня',
            'date_of_agreement'=>'Дата договора',
            'street_id'=>'Улица',
            'comment'=>'Комментарий',
            'time_to_delivery_from'=>'Время доставки с',
            'time_to_delivery_to'=>'Время доставки до',
            'contact'=>'Контактное лицо',
        ];
    }

    public function rules(){
        return[
            [['name','house'],'string','max'=>100],
            [['email','number'],'string','max'=>50],
            [['number','name','house','email','contact'],'trim'],
            [['email'],'email'],
            [['date_of_create','time_to_delivery_from','time_to_delivery_to','comment'],'safe'],
            [['subject_id','region_id','town_id','street_id','user_id'],'integer'],
            [['name','region_id','town_id','street_id','email','number','house','status_id','date_of_agreement','user_id'],'required']
        ];
    }
}