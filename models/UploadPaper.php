<?php


namespace app\models;

use yii\db\ActiveRecord;

class UploadPaper extends ActiveRecord
{

    public function getMaterial(){
        return $this->hasOne(Material::class,['material_id_from_provider'=>'material_id_from_provider']);
    }

    public function attributeLabels(){
        return[
            'id'=>'ID',
            'pallet_id'=>'ID палета от поставщика',
            'roll_id'=>'ID ролика от поставщика',
            'material_id_from_provider'=>'ID от поставщика',
            'width'=>'Ширина',
            'length'=>'Длина',
        ];
    }

//    public function rules(){
//        return[
//        ];
//    }

}