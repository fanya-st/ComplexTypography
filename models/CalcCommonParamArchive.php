<?php


namespace app\models;


use yii\db\ActiveRecord;

class CalcCommonParamArchive extends ActiveRecord
{

    public function getCalcCommonParam(){
        return $this->hasOne(CalcCommonParam::class,['id'=>'calc_common_param_id']);
    }


    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'calc_common_param_id'=>'Параметр',
            'value'=>'Значение',
            'date'=>'Дата',
        ];
    }

    public function rules(){
        return[
            [['date'],'safe'],
            [['id','calc_common_param_id'],'integer'],
            [['value'],'double'],
            [['value','calc_common_param_id'],'required']
        ];
    }

    public static function getCommonParamArchive($date,$value_attribute){
        $value=CalcCommonParamArchive::find()->joinWith('calcCommonParam')->where(['calc_common_param.name'=>$value_attribute])->andWhere(['<=', 'calc_common_param_archive.date', $date])->orderBy(['calc_common_param_archive.date'=>SORT_DESC])->one()->value;
        if(empty($value))
            $value=CalcCommonParamArchive::find()->joinWith('calcCommonParam')->where(['calc_common_param.name'=>$value_attribute])->andWhere(['>=', 'calc_common_param_archive.date', $date])->orderBy(['calc_common_param_archive.date'=>SORT_ASC])->one()->value;
        return $value;
    }
}