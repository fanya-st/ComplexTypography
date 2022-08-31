<?php


namespace app\models;


use yii\base\Model;

class LabelStatus extends Model
{
    public static $label_status = [
        1=>'Новая этикетка',
        2=>'В дизайне',
        3=>'Дизайн готов',
        4=>'Дизайн утвержден',
        5=>'Ожидает перевывода',
        6=>'Prepress',
        7=>'Prepress готов',
        8=>'Перевывод готов',
        9=>'Изготовлние форм',
        10=>'Готов к печати',
        11=>'В архиве',
    ];

}