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

//    public function getMaterialGroupId(){
//        return $this->materialGroup->id;
//    }
//
//    public function getMaterialName(){
//        return $this->material->name;
//    }

    public function attributeLabels()
    {
        return [
            'id'=>'ID ролика',
            'date_of_create'=>'Дата создания',
            'length'=>'Длина',
            'materialName'=>'Наименование',
            'width'=>'Ширина',
        ];
    }

}