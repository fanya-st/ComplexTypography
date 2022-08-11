<?php


namespace app\models;


use yii\db\ActiveRecord;

class Pants extends ActiveRecord
{
    public function getShaft(){
        return $this->hasOne(Shaft::class,['id'=>'shaft_id']);
    }

    public function getPantsKind(){
        return $this->hasOne(PantsKind::class,['id'=>'pants_kind_id']);
    }

    public function getKnifeKind(){
        return $this->hasOne(KnifeKind::class,['id'=>'knife_kind_id']);
    }

    public function getMaterialGroup(){
        return $this->hasOne(MaterialGroup::class,['id'=>'material_group_id']);
    }

    public function getMashinePants(){
        return $this->hasMany(MashinePants::class,['pants_id'=>'id']);
    }

    public function getMashine(){
        return $this->hasMany(Mashine::class,['id'=>'mashine_id'])->via('mashinePants');
    }



    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'name'=>'Наименование',
            'pants_kind_id'=>'Вид штанца',
            'knife_kind_id'=>'Тип ножа',
            'knife_width'=>'Ширина ножа',
            'picture'=>'Изображение',
            'paper_width'=>'Ширина бумаги',
            'width_label'=>'Ширина этикетки',
            'height_label'=>'Высота этикетки',
            'shaft_id'=>'Вал',
            'cuts'=>'Высечки',
            'radius'=>'Радиус',
            'gap'=>'Зазор',
            'material_group_id'=>'Тип материала',
        ];
    }

    public function rules(){
        return[
            [['id','pants_kind_id','knife_kind_id','shaft_id','material_group_id','knife_width','paper_width','cuts'],'integer'],
            [['name','picture'],'trim'],
            [['name'],'string','max'=>50],
            [['radius','gap','width_label','height_label'],'double'],
            [['picture'],'safe'],
        ];
    }
}