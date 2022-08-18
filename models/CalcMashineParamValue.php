<?php


namespace app\models;
use yii;
use yii\helpers\ArrayHelper;

use yii\db\ActiveRecord;

class CalcMashineParamValue extends ActiveRecord
{

    public function getMashine(){
        return $this->hasOne(Mashine::class,['id'=>'mashine_id']);
    }

    public function getCalcMashineParam(){
        return $this->hasOne(CalcMashineParam::class,['id'=>'calc_mashine_param_id']);
    }

    public static function getMashineParam($mashine_id){
        $mashine_param=CalcMashineParamValue::find()->joinWith('calcMashineParam')->where(['mashine_id'=>$mashine_id])->all();
        foreach ($mashine_param as $param){
            ArrayHelper::setValue($mashine_param_array, $param->calcMashineParam->name, floatval($param->value));
        }

        return $mashine_param_array;
    }



    public function attributeLabels()
    {
        return [
            'mashine_id'=>'Станок',
            'calc_mashine_param_id'=>'Параметр',
            'date'=>'Дата',
            'value'=>'Значение',
            'id'=>'ID',
        ];
    }

    public function rules(){
        return[
            [['value'],'double'],
            [['date'],'safe'],
            [['id','mashine_id','calc_mashine_param_id'],'integer'],
            [['mashine_id','calc_mashine_param_id','value'],'required']
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->date=Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                Yii::$app->session->setFlash('success', 'Добавлен новый параметр!');
            } else {
                if ($this->getOldAttribute('value')!=$this->value) {
                    $archive=new CalcMashineParamValueArchive();
                    $archive->calc_mashine_param_value_id=$this->id;
                    $archive->value=$this->getOldAttribute('value');
                    $archive->date=$this->getOldAttribute('date');
                    $archive->save();
                }
                Yii::$app->session->setFlash('success', 'Параметр изменен!');
            }
            return true;
        } else {
            return false;
        }
    }

}