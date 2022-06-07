<?php


namespace app\models;


use yii\db\ActiveRecord;

class PhotoOutput extends ActiveRecord
{
    public static $dpi = [
        1=>[
        ['id'=>'2400','name'=>'2400'],
    ],
        2=>[
        ['id'=>'2540','name'=>'2540'],
        ['id'=>'5080','name'=>'5080'],
    ]
    ];

}