<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii;

class OrderForm extends ActiveRecord{

    public $parent_label;

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
		'parent_label'=>'С внесением изменений в этикетку',
            'tech_note'=>'Примечание технолога',
		];
	}
    public function rules(){
        return[
            [['status_id','label_id','stretch','cut_edge','label_on_roll','winding_id',
                'sleeve_id','sending','material_id','mashine_id','parent_label','printed_circulation'],'integer'],
            [['tech_note','printer_note','rewinder_note','manager_note','packer_login','rewinder_login','printer_login'],'trim'],
            [['packer_login','rewinder_login','printer_login'],'string','max'=>50],
            [['label_price_with_tax','label_price'],'number'],
            [['plan_circulation','sending','label_price_with_tax','label_price','stretch','cut_edge','sleeve_id',
                'material_id','mashine_id','date_of_sale','winding_id','label_on_roll'],'required'],
            [['date_of_sale','date_of_create','date_of_variable_print_begin','date_of_packing_begin','date_of_rewind_begin',
                'date_of_print_end','date_of_variable_print_end','date_of_rewind_end','date_of_packing_end'],'safe'],
        ];
    }

    public function beforeValidate()
    {
        //Проверяем если нет статуса, то ставим статус "Новый"
        if (empty($this->status_id)) {
            $this->status_id = 1;
        }
        return parent::beforeValidate();
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            Yii::$app->session->setFlash('success', 'Заказ создан !');
        } else {
            Yii::$app->session->setFlash('success', 'Заказ обновлен !');
        }
    }


}