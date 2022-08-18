<?php

namespace app\models;

use Yii;


class EnterpriseCostService extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'enterprise_cost_service';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
        ];
    }
}
