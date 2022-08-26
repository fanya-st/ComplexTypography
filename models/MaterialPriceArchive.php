<?php


namespace app\models;


use yii\db\ActiveRecord;

class MaterialPriceArchive extends ActiveRecord
{
    public function getMaterial(){
        return $this->hasOne(Material::class,['id'=>'material_id']);
    }

    public static function tableName()
    {
        return 'material_price_archive';
    }

    public static function getPriceAverage($material_list,$date,$exception_material_group=null,$material_group=null){
        $count=Material::find()->andFilterWhere(['id'=>$material_list])
            ->andFilterWhere(['not in','material_group_id' ,$exception_material_group])
            ->andFilterWhere(['material_group_id' => $material_group])->count();
        foreach ($material_list as $material){
            $price_euro=MaterialPriceArchive::find()->joinWith('material')->where(['material_price_archive.material_id'=>$material])
                ->andFilterWhere(['not in','material.material_group_id' ,$exception_material_group])
                ->andFilterWhere(['material.material_group_id' => $material_group])
                ->andFilterWhere(['<=','material_price_archive.date_of_change' ,$date])
                ->orderBy(['material_price_archive.date_of_change'=>SORT_DESC])->one();
            if(empty($price_euro))
                $price_euro=MaterialPriceArchive::find()->joinWith('material')->andFilterWhere(['material_price_archive.material_id'=>$material])
                    ->andFilterWhere(['not in','material.material_group_id' ,$exception_material_group])
                    ->andFilterWhere(['material.material_group_id' => $material_group])
                    ->andFilterWhere(['>=','material_price_archive.date_of_change' ,$date])
                    ->orderBy(['material_price_archive.date_of_change'=>SORT_ASC])->one();
            $value+=$price_euro->old_value;
        }
        if($count==0)
            return 0;
        else
            return $value/$count;
    }
}