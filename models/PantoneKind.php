<?php

namespace app\models;

use Yii;


class PantoneKind extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'pantone_kind';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string','max'=>50],
            [['name'], 'trim'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Тип PANTONE',
        ];
    }
}
