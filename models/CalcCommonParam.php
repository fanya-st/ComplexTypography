<?php


namespace app\models;
use yii;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class CalcCommonParam extends ActiveRecord
{
    public function getCalcCommonParamArchive(){
        return $this->hasMany(CalcCommonParamArchive::class,['calc_common_param_id'=>'id']);
    }

    public static function getCommonParam(){
        $common_param=CalcCommonParam::find()->all();
        foreach ($common_param as $param){
            ArrayHelper::setValue($common_param_array, $param->name, $param->value);
        }

        return $common_param_array;
    }

    public function attributeLabels()
    {
        return [
            'name'=>'Параметр',
            'subscribe'=>'Описание',
            'id'=>'ID',
            'value'=>'Значение',
            'date'=>'Дата',
        ];
    }

    public function rules(){
        return[
            [['name'],'string','max'=>50],
            [['subscribe'],'string','max'=>100],
            [['name','subscribe'],'trim'],
            [['date'],'safe'],
            [['id'],'integer'],
            [['value'],'double'],
            [['name','value','date','subscribe'],'required']
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                Yii::$app->session->setFlash('success', 'Добавлен новый параметр!');
            } else {
                if ($this->getOldAttribute('value')!=$this->value) {
                    $archive=new CalcCommonParamArchive();
                    $archive->calc_common_param_id=$this->id;
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