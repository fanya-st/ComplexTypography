<?php


namespace app\models;


use yii\db\ActiveRecord;

class FormOrderHistory extends ActiveRecord
{
    public function getForm(){
        return $this->hasOne(Form::class,['id'=>'form_id']);
    }

}