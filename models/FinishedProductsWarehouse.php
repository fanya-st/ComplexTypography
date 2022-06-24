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
            'packed_roll_count'=>'Упаковано',
            'roll_count'=>'Кол-во роликов',
        ];
    }

    public function rules(){
        return[
            [['order_id','label_in_roll','roll_count'],'required'],
            [['packed_roll_count','packed_box_count','packed_bale_count','sended_roll_count','sended_box_count','sended_bale_count'], 'default', 'value' => 0],

        ];
    }
}