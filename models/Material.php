<?php


namespace app\models;


use yii\db\ActiveRecord;

class Material extends ActiveRecord
{
    public function getMeterialGroup(){
        return $this->hasOne(MaterialGroup::class,['id'=>'material_group_id']);
    }
}