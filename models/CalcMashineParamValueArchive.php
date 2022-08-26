<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
            [['calc_mashine_param_value_id','value'],'required']
        ];
    }

    public static function getMashineParamArchive($mashine_id,$date,$value_attribute){
        $value=CalcMashineParamValueArchive::find()->joinWith('calcMashineParamValue.calcMashineParam')->where(['calc_mashine_param_value.mashine_id'=>$mashine_id,'calc_mashine_param.name'=>$value_attribute])->andWhere(['<=', 'calc_mashine_param_value_archive.date', $date])->orderBy(['calc_mashine_param_value_archive.date'=>SORT_DESC])->one()->value;
        if(empty($value))
            $value=CalcMashineParamValueArchive::find()->joinWith('calcMashineParamValue.calcMashineParam')->where(['calc_mashine_param_value.mashine_id'=>$mashine_id,'calc_mashine_param.name'=>$value_attribute])->andWhere(['>=', 'calc_mashine_param_value_archive.date', $date])->orderBy(['calc_mashine_param_value_archive.date'=>SORT_ASC])->one()->value;
        return $value;
    }

}