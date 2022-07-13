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
            'price_rub'=>'Цена в рублях за м2',
            'price_rub_discount'=>'Цена в рублях за м2 со скидкой',
            'price_euro'=>'Цена в евро за м2',
            'price_euro_discount'=>'Цена в евро за м2 со скидкой',
            'density'=>'Плотность г/м2',
            'status'=>'Статус',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Материал добавлен!');
            } else {
                if ($this->getOldAttribute('price_rub')!=$this->price_rub) {
                    $archive=new MaterialPriceArchive();
                    $archive->material_id=$this->id;
                    $archive->price_attribute='price_rub';
                    $archive->old_value=$this->getOldAttribute('price_rub');
                    $archive->save();
                }
                if ($this->getOldAttribute('price_rub_discount')!=$this->price_rub_discount) {
                    $archive=new MaterialPriceArchive();
                    $archive->material_id=$this->id;
                    $archive->price_attribute='price_rub_discount';
                    $archive->old_value=$this->getOldAttribute('price_rub_discount');
                    $archive->save();
                }
                if ($this->getOldAttribute('price_euro_discount')!=$this->price_euro_discount) {
                    $archive=new MaterialPriceArchive();
                    $archive->material_id=$this->id;
                    $archive->price_attribute='price_euro_discount';
                    $archive->old_value=$this->getOldAttribute('price_euro_discount');
                    $archive->save();
                }
                if ($this->getOldAttribute('price_euro')!=$this->price_euro) {
                    $archive=new MaterialPriceArchive();
                    $archive->material_id=$this->id;
                    $archive->price_attribute='price_euro';
                    $archive->old_value=$this->getOldAttribute('price_euro');
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