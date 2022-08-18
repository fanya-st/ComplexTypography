<?php


namespace app\models;
use yii\helpers\ArrayHelper;

class StockOnHandPaper extends Material
{
    public static function tableName()
    {
        return 'material';
    }

    public $paper_warehouse;

    public function attributeLabels()
    {
        return [
        ];
    }

    public function rules()
    {
        return [
            [['paper_warehouse'], 'safe'],
        ];
    }

    public function StockOnHand($stock_date){
        //обрабатываем в цикле ролики со склада бумаги
        foreach ($this->paperWarehouse as $paper_warehouse){
            //приход с периода выборки и до сегодняшнего дня отнимаем
            if(date_create($paper_warehouse->date_of_create) <= date_create($stock_date)){
                //обрабатываем в цикле введенный расход по каждому ролику со склада
                foreach($paper_warehouse->orderMaterial as $order_material){
                    if(date_create($order_material->date) >= date_create($stock_date)){
                        //расход с периода выборки и до сегодняшнего дня прибавляем
                        $paper_warehouse->length+=$order_material->length;
                    }
                }
                ArrayHelper::setValue($stock,$paper_warehouse->id,$paper_warehouse);
            }
        }

        $this->paper_warehouse=$stock;
    }

    public static function getTotal($provider,$time)
    {
        $total = 0;

        foreach ($provider as $item) {
            $item->stockOnHand($time);
            if(!empty($item->paper_warehouse))
                foreach($item->paper_warehouse as $paper_warehouse){
                    $total+=$paper_warehouse->length*$paper_warehouse->width;
                }
        }

        return 'Общая, м2: '.round($total/1000,2);
    }

}