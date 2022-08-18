<?php


namespace app\models;


use yii\db\ActiveRecord;

class CalcMashineParamValueArchive extends ActiveRecord
{
    public function getCalcMashineParamValue(){
        return $this->hasOne(CalcMashineParamValue::class,['id'=>'calc_mashine_param_value_id']);
    }

    public function attributeLabels()
    {
        return [
            'calc_mashine_param_value_id'=>'Параметр',
            'date'=>'Дата',
            'value'=>'Значение',
            'id'=>'ID',
        ];
    }

    public function rules(){
        return[
            [['value'],'double'],
            [['date'],'safe'],
            [['id','calc_mashine_param_value_id'],'integer'],
            [['calc_mashine_param_value_id','value','date'],'required']
        ];
    }

}