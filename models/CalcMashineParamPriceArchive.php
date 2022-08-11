<?php


namespace app\models;


use yii\db\ActiveRecord;

class CalcMashineParamPriceArchive extends ActiveRecord
{
    public function getCalcMashineParamPrice(){
        return $this->hasOne(CalcMashineParamPrice::class,['id'=>'calc_mashine_param_price_id']);
    }

    public function attributeLabels()
    {
        return [
            'calc_mashine_param_price_id'=>'Параметр',
            'date'=>'Дата',
            'value'=>'Значение',
            'id'=>'ID',
        ];
    }

    public function rules(){
        return[
            [['value'],'double'],
            [['date'],'safe'],
            [['id','calc_mashine_param_price_id'],'integer'],
            [['calc_mashine_param_price_id','value','date'],'required']
        ];
    }

}