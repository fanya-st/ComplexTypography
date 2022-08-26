<?php


namespace app\models;
use yii;


use yii\db\ActiveRecord;

class Material extends ActiveRecord
{
    public function getMaterialGroup(){
        return $this->hasOne(MaterialGroup::class,['id'=>'material_group_id']);
    }

    public function getMaterialProvider(){
        return $this->hasOne(MaterialProvider::class,['id'=>'material_provider_id']);
    }

    public function getMaterialPriceArchive(){
        return $this->hasMany(MaterialPriceArchive::class,['material_id'=>'id']);
    }

    public function getPaperWarehouse(){
        return $this->hasMany(PaperWarehouse::class,['material_id'=>'id']);
    }




    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'date_of_create'=>'Дата создания',
            'name'=>'Наименование',
            'short_name'=>'Кр.наим',
            'prompt'=>'Подсказка',
            'materialProvider.name'=>'Поставщик',
            'material_provider_id'=>'Поставщик',
            'materialGroup.name'=>'Тип',
            'material_group_id'=>'Тип',
            'price_euro'=>'Цена евро/м2',
            'density'=>'Плотность г/м2',
            'status'=>'Статус',
            'material_id_from_provider'=>'ID от поставщика',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Материал добавлен!');
            } else {
                if ($this->getOldAttribute('price_euro')!=$this->price_euro) {
                    $archive=new MaterialPriceArchive();
                    $archive->material_id=$this->id;
                    $archive->old_value=$this->price_euro;
                    $archive->save();
                }
                Yii::$app->session->setFlash('success', 'Материал обновлен!');
            }
            return true;
        } else {
            return false;
        }
    }
}