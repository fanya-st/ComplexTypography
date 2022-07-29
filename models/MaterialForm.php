<?php


namespace app\models;


class MaterialForm extends Material
{
    public static function tableName()
    {
        return 'material';
    }

    public function rules(){
        return[
            [['name','material_group_id','material_provider_id'],'required'],
            [['name','short_name','prompt'],'trim'],
            [['name','short_name','prompt'],'string','length'=>[0,100]],
            [['id','density','material_group_id','material_provider_id','material_id_from_provider'],'integer'],
            [['status'],'boolean'],
            [['price_rub','price_euro','price_rub_discount','price_euro_discount'],'double']
        ];
    }
}