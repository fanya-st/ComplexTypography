<?php

namespace app\models;

use Yii;


class EnterpriseCost extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'enterprise_cost';
    }

    public function getEnterpriseCostService(){
        return $this->hasOne(EnterpriseCostService::class,['id'=>'service_id']);
    }




    public function rules()
    {
        return [
            [['date'], 'safe'],
            [[ 'service_id', 'cost'], 'required'],
            [['service_id'], 'integer'],
            [['cost'], 'number'],
            [['login'], 'string', 'max' => 50],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'login' => 'Сотрудник',
            'service_id' => 'Услуга',
            'cost' => 'Затрата, руб',
        ];
    }
}
