<?php

namespace app\models;

use yii\db\ActiveRecord;

class OrderForm extends ActiveRecord{
	public static function tableName(){
		return 'order';
	}
	
	public function attributeLabels(){
		return[
		'name'=>'Наименование заказа',
		'date_of_sale'=>'Дата сдачи заказа',
		'label_id'=>'Этикетка',
		'plan_circulation'=>'Плановый тираж',
		'material_id'=>'Материал',
		'mashine_id'=>'Машина',
		'label_price'=>'Цена этикетки',
		'trial_circulation'=>'Это пробный тираж?',
		'sending'=>'Отправка',
		'sleeve_id'=>'Втулка D, мм',
		'winding_id'=>'Схема намотки',
		'diameter_roll'=>'Диаметр ролика, мм',
		'label_on_roll'=>'Этикеток на ролике, шт',
		'cut_edge'=>'Кромки',
		'stretch'=>'Стретч лента',
		'rewinder_note'=>'Примечание для перемотки',
		];
	}
	public function rules(){
		return[
		[['name','date_of_sale','label_id','plan_circulation','material','label_price','sleeve_id','winding_id','diameter_roll','label_on_roll','stretch'],'required'],
		[['name','label_id','manager_login','status_id','plan_circulation','material','label_price','rewinder_note'],'trim']
		];
	}
	
}