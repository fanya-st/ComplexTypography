<?php


namespace app\models;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;


use yii\db\ActiveRecord;

class Envelope extends ActiveRecord
{

    public function getShelf(){
        return $this->hasOne(Shelf::class,['id'=>'shelf_id']);
    }

    public static $location=[
        //цвет1
        'color1'=>[
            1=>['id'=>'1','name'=>'blue'],
            2=>['id'=>'2','name'=>'green'],
            3=>['id'=>'3','name'=>'red'],
            4=>['id'=>'4','name'=>'yellow'],
            5=>['id'=>'5','name'=>'cyan'],
            6=>['id'=>'6','name'=>'black'],
        ],
        //цвет1
        'color2'=>[
            1=>['id'=>'1','name'=>'blue'],
            2=>['id'=>'2','name'=>'green'],
            3=>['id'=>'3','name'=>'red'],
            4=>['id'=>'4','name'=>'yellow'],
            5=>['id'=>'5','name'=>'cyan'],
            6=>['id'=>'6','name'=>'black'],
        ],
    ];

    public function getIdWithColor(){
        return $this->id.' '.html::tag('svg',html::tag('rect','',['width'=>17, 'height'=>17,'style'=>'fill:'.Envelope::$location['color1'][$this->color1]['name'].';']),['width'=>17, 'height'=>17]).' '.
            html::tag('svg',html::tag('rect','',['width'=>17, 'height'=>17,'style'=>'fill:'.Envelope::$location['color2'][$this->color2]['name'].';']),['width'=>17, 'height'=>17]);
        }

    public function getColorOne(){
        return html::tag('svg',html::tag('rect','',['width'=>17, 'height'=>17,'style'=>'fill:'.Envelope::$location['color1'][$this->color1]['name'].';']),['width'=>17, 'height'=>17]);
    }
    public function getColorTwo(){
        return html::tag('svg',html::tag('rect','',['width'=>17, 'height'=>17,'style'=>'fill:'.Envelope::$location['color1'][$this->color2]['name'].';']),['width'=>17, 'height'=>17]);
    }

    public static function getDropDownOptionsColorTwo(){
        ArrayHelper::setValue($array, 'prompt',['text' => '', 'options' => ['value' => '', 'class' => 'prompt', 'label' => '']]);
        foreach (Envelope::$location['color2'] as $item){
            ArrayHelper::setValue($array, 'options.'.$item['id'], ['style'=>'background:'.$item['name'].';']);
        }
        return  $array;
    }

    public static function getDropDownOptionsColorOne(){
        ArrayHelper::setValue($array, 'prompt',['text' => '', 'options' => ['value' => '', 'class' => 'prompt', 'label' => '']]);

        foreach (Envelope::$location['color1'] as $item){
            ArrayHelper::setValue($array, 'options.'.$item['id'], ['style'=>'background:'.$item['name'].';']);
        }
        return  $array;
    }



    public function attributeLabels()
    {
        return [
            'shelf_id'=>'Полка',
            'color1'=>'Цвет 1',
            'color2'=>'Цвет 2',
            'id'=>'ID',
        ];
    }

    public function rules(){
        return[
            [['shelf_id','color1','color2'],'integer'],
        ];
    }
}