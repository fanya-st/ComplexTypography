<?php


namespace app\models;


use yii\db\ActiveRecord;

class CalcCommonParamArchive extends ActiveRecord
{
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
            [['value','date','calc_common_param_id'],'required']
        ];
    }
}