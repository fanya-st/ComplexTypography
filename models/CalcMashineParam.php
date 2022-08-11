<?php


namespace app\models;


use yii\db\ActiveRecord;

class CalcMashineParam extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'name'=>'Параметр',
            'subscribe'=>'Описание',
            'id'=>'ID',
        ];
    }

    public function rules(){
        return[
            [['name'],'string','max'=>50],
            [['subscribe'],'string','max'=>100],
            [['name','subscribe'],'trim'],
            [['id'],'integer'],
            [['name','subscribe'],'required']
        ];
    }

}