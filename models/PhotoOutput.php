<?php


namespace app\models;


use yii\db\ActiveRecord;

class PhotoOutput extends ActiveRecord
{
    public static $dpi = [
        0=>[
        ['id'=>'1','name'=>'2400'],
    ],
        1=>[
        ['id'=>'1','name'=>'2540'],
        ['id'=>'2','name'=>'5080'],
    ]
    ];

}