<?php

namespace app\models;

use Yii;


class BusinessTripEmployee extends \yii\db\ActiveRecord
{

    public static $trip_status = [
//        0=>'Открыт',
        1=>'Открыт',
        2=>'Закрыт',
    ];

    public static function tableName()
    {
        return 'business_trip_employee';
    }

    public function getTransport(){
        return $this->hasOne(Transport::class,['id'=>'transport_id']);
    }

    public function getCustomer(){
        return $this->hasOne(Customer::class,['id'=>'customer_id']);
    }

    public function rules()
    {
        return [
            [['date_of_begin', 'user_id', 'transport_id'], 'required'],
            [['date_of_begin', 'date_of_end'], 'safe'],
            [['gasoline_cost', 'cost'], 'number'],
            [['transport_id', 'status_id','user_id','customer_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_of_begin' => 'Дата начала',
            'date_of_end' => 'Дата окончания',
            'gasoline_cost' => 'ГСМ, руб',
            'cost' => 'Командировочные',
            'user_id' => 'Сотрудник',
            'transport_id' => 'Транспорт',
            'customer_id' => 'Заказчик',
            'status_id' => 'Статус',
            'comment' => 'Комментарий',
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Командировка добавлена');
            } else {
                Yii::$app->session->setFlash('success', 'Командировка обновлена');
            }
            return true;
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка');
            return false;
        }
    }

}
