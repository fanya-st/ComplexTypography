<?php

namespace app\models;

use Yii;


class PantonePriceArchive extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'pantone_price_archive';
    }

    public function rules()
    {
        return [
            [['pantone_id', 'old_value'], 'required'],
            [['pantone_id'], 'integer'],
            [['date_of_change'], 'safe'],
            [['old_value'], 'double'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pantone_id' => 'PANTONE',
            'date_of_change' => 'Дата изменения',
            'old_value' => 'Старое значение',
        ];
    }

    public static function getPriceAverage($date,$pantone_kind=null,$mashine_id=null,$mashine_type=null){
        $pantone=MashinePantone::find()->joinWith('mashine')->joinWith('pantone')
            ->select('mashine_pantone.pantone_id')
            ->andFilterWhere(['mashine.mashine_type'=>$mashine_type])
            ->andFilterWhere(['pantone.pantone_kind_id'=>$pantone_kind])
            ->andFilterWhere(['mashine.id'=>$mashine_id])->column();
        foreach($pantone as $p){
            $price_euro=PantonePriceArchive::find()
                ->andFilterWhere(['pantone_id' => $p])
                ->andFilterWhere(['<=','date_of_change' ,$date])
                ->orderBy(['date_of_change'=>SORT_DESC])->one();
            if(empty($price_euro))
                $price_euro=PantonePriceArchive::find()
                    ->andFilterWhere(['pantone_id' => $p])
                    ->andFilterWhere(['>=','date_of_change' ,$date])
                    ->orderBy(['date_of_change'=>SORT_ASC])->one();
            $value+=$price_euro->old_value;
        }
        if(!empty($pantone))
            return $value/count($pantone);
    }
}
