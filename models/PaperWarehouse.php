<?php


namespace app\models;


use yii\db\ActiveRecord;

class PaperWarehouse extends ActiveRecord
{
    public function getMaterial(){
        return $this->hasOne(Material::class,['id'=>'material_id']);
    }

}