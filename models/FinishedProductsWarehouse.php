<?php


namespace app\models;


use yii\db\ActiveRecord;

class FinishedProductsWarehouse extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'id'=>'Номер ролика',
            'label_in_roll'=>'Кол-во этикеток в ролике',
            'packed_count'=>'Упаковано',
            'count'=>'Кол-во роликов',
        ];
    }

    public function rules(){
        return[
            [['order_id','label_in_roll','count','packed_count'],'required'],
            ['packed_count', 'default', 'value' => 0],

        ];
    }
}