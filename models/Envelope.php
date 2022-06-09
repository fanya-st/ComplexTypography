<?php


namespace app\models;


use yii\db\ActiveRecord;

class Envelope extends ActiveRecord
{
    public $new_checkbox;
    public $rack_id;
    public $shelf_id;
    public static $location=[
        //полка
        'shelf'=>[
            1=>['id'=>'1','name'=>'[Полка№1]'],
            2=>['id'=>'2','name'=>'[Полка№2]'],
            3=>['id'=>'3','name'=>'[Полка№3]'],
            4=>['id'=>'4','name'=>'[Полка№4]'],
            5=>['id'=>'5','name'=>'[Полка№5]'],
            6=>['id'=>'6','name'=>'[Полка№6]'],
        ],
        //стелаж
        'rack'=>[
            1=>['id'=>'1','name'=>'[Стелаж№1]'],
            2=>['id'=>'2','name'=>'[Стелаж№2]'],
            3=>['id'=>'3','name'=>'[Стелаж№3]'],
            4=>['id'=>'4','name'=>'[Стелаж№4]'],
            5=>['id'=>'5','name'=>'[Стелаж№5]'],
        ],
    ];

    public function getFullLocationName(){
        return $this->id.' '.Envelope::$location['rack'][$this->rack]['name'].' '.Envelope::$location['shelf'][$this->shelf]['name'];
    }

    public function attributeLabels()
    {
        return [
            'new_checkbox'=>'Новый конверт',
            'rack_id'=>'Стелаж',
            'shelf_id'=>'Полка',
        ];
    }

    public function rules(){
        return[
            [['new_checkbox','rack','shelf','rack_id','shelf_id'],'safe'],
        ];
    }
}