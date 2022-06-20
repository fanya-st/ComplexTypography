<?php


namespace app\models;


use yii\db\ActiveRecord;

class CombinationForm extends ActiveRecord
{
    public function rules(){
        return[
            [['label_id'],'safe']
        ];
    }

}