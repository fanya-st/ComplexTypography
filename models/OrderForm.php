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
		];
	}
	public function rules(){
		return[
		[['name','date_of_sale','label_id','plan_circulation','material','label_price'],'required'],
		[['name','label_id','manager_login','status_id','plan_circulation','material','label_price'],'trim']
		];
	}
	
}