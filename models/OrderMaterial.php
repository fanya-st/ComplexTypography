<?php


namespace app\models;


use yii\db\ActiveRecord;

class OrderMaterial extends ActiveRecord
{
    public function getPaperWarehouse(){
        return $this->hasOne(PaperWarehouse::class,['id'=>'paper_warehouse_id']);
    }

    public function getMaterialName(){
        return $this->paperWarehouse->material->name;
    }

    public function rules(){
        return[
            [['length','paper_warehouse_id'], 'integer'],
            [['order_id','length','paper_warehouse_id'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'length'=>'Длина',
            'paper_warehouse_id'=>'Штрихкод (ID) ролика',
            'order_id'=>'ID заказа',
        ];
    }

    public function beforeValidate()
    {
        $this->paper_warehouse_id = mb_substr("$this->paper_warehouse_id",0,12);
        $this->paper_warehouse_id = (int)$this->paper_warehouse_id;
        return true;
    }
}