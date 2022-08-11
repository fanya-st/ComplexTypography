<?php

namespace app\models;

use yii\db\ActiveRecord;

class OrderForm extends ActiveRecord{
	public static function tableName(){
		return 'order';
	}
	public function attributeLabels(){
		return[
		'date_of_sale'=>'Дата сдачи заказа',
		'label_id'=>'Этикетка',
		'plan_circulation'=>'Плановый тираж',
		'material_id'=>'Материал',
		'mashine_id'=>'Машина',
		'label_price'=>'Цена этикетки, руб',
		'label_price_with_tax'=>'Цена этикетки с НДС, руб',
		'trial_circulation'=>'Это пробный тираж?',
		'sending'=>'Отправка',
		'sleeve_id'=>'Втулка D, мм',
		'winding_id'=>'Схема намотки',
		'diameter_roll'=>'Диаметр ролика, мм',
		'label_on_roll'=>'Этикеток на ролике, шт',
		'cut_edge'=>'Кромки',
		'stretch'=>'Стретч лента',
		'rewinder_note'=>'Примечание перемотчика',
		'printer_note'=>'Примечание печатника',
		'manager_note'=>'Примечание менеджера',
            'tech_note'=>'Примечание технолога',
		'order_price'=>'Сумма за заказ, руб',
		'order_price_with_tax'=>'Сумма за заказ с НДС, руб',
		];
	}
	public function rules(){
		return[
		[['date_of_sale','label_id','trial_circulation','label_price','sleeve_id',
            'material_id','mashine_id','winding_id','stretch','cut_edge','order_price','order_price_with_tax',
            'label_price_with_tax','material_id','status_id'],'required'],
		[['rewinder_note','printer_note','manager_note'],'trim'],
            [['plan_circulation','sending','label_on_roll'],'integer'],
            [['order_price','order_price_with_tax',
                'label_price_with_tax','label_price'],'double']
		];
	}
}