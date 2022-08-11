<?php


namespace app\models;
use yii;

use yii\db\ActiveRecord;

class CalcMashineParamPrice extends ActiveRecord
{

    public function getMashine(){
        return $this->hasOne(Mashine::class,['id'=>'mashine_id']);
    }

    public function getCalcMashineParam(){
        return $this->hasOne(CalcMashineParam::class,['id'=>'calc_mashine_param_id']);
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
                    $archive=new CalcMashineParamPriceArchive();
                    $archive->calc_mashine_param_price_id=$this->id;
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