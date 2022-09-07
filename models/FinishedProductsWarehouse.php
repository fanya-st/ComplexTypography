<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class FinishedProductsWarehouse extends ActiveRecord
{
    public function getOrder(){
        return $this->hasOne(Order::class,['id'=>'order_id']);
    }

    public function getLabel(){
        return $this->hasOne(Label::class,['id'=>'label_id']);
    }

    public function getCustomer(){
        return $this->hasOne(Customer::class,['id'=>'customer_id'])->via('label');
    }

//    public function search($params)
//    {
//        $dataProvider = new ActiveDataProvider([
//            'query' => FinishedProductsWarehouse::find(),
//        ]);
//
//        $this->load($params);
//
//        return $dataProvider;
//    }

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
            [['label_id','label_in_roll','roll_count'],'required'],
            [['manager_id'],'integer'],
            [['id','defect_roll_count','previous_order_id','defect_note','defect_note'],'safe'],
            [['packed_roll_count','packed_box_count','packed_bale_count','sended_roll_count','sended_box_count','sended_bale_count'], 'default', 'value' => 0],

        ];
    }
}