<?php

namespace app\models;

use Yii;


class PantonePriceArchive extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'pantone_price_archive';
    }

    public function rules()
    {
        return [
            [['pantone_id', 'price_attribute', 'old_value'], 'required'],
            [['pantone_id'], 'integer'],
            [['date_of_change'], 'safe'],
            [['old_value'], 'double'],
            [['price_attribute'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pantone_id' => 'PANTONE',
            'date_of_change' => 'Дата изменения',
            'price_attribute' => 'Аттрибут цены',
            'old_value' => 'Старое значение',
        ];
    }
}
