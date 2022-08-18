<?php


namespace app\models;


use yii\db\ActiveRecord;

class PaperWarehouse extends ActiveRecord
{

    public function getMaterial(){
        return $this->hasOne(Material::class,['id'=>'material_id']);
    }

    public function getMaterialGroup(){
        return $this->hasOne(MaterialGroup::class,['id'=>'material_group_id'])->via('material');
    }

    public function getShelf(){
        return $this->hasOne(Shelf::class,['id'=>'shelf_id']);
    }

    public function getOrderMaterial(){
        return $this->hasMany(OrderMaterial::class,['paper_warehouse_id'=>'id']);
    }



    public function attributeLabels()
    {
        return [
            'id'=>'ID ролика',
            'date_of_create'=>'Дата создания',
            'length'=>'Длина',
            'width'=>'Ширина',
            'shelf_id'=>'Полка',
        ];
    }

    public function rules()
    {
        return [
            [['id','shelf_id','width','length'], 'integer'],
            [['date_of_create'], 'safe'],
        ];
    }

}