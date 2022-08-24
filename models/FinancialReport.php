<?php


namespace app\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class FinancialReport extends Order
{
    public static function tableName()
    {
        return 'order';
    }

    public $actual_circulation;
    public $material_list;//массив с использованными в заказе бумагами, фольгой, ламинацией
    public $length_clear_circulation;
    public $square_clear_circulation;
    public $length_order;
    public $square_order;
    public $square_foil;
    public $square_laminate;
    public $paint_weight;
    public $varnish_weight;
    public $order_weight;
    public $square_form;
    public $paper_price;
    public $paint_price;
    public $varnish_price;
    public $form_price;
    public $laminate_price;
    public $foil_price;
    public $all_form_count;
    public $order_form_count;
    public $stencil_price;
    public $transport_price;
    public $circulation_price;
    public $efficiency_ratio;
    public $print_time;
    public $enterprise_cost;


    public function attributeLabels()
    {
        return [
            'actual_circulation'=>'Фактический тираж, шт',
            'material_list'=>'Материал',
            'length_clear_circulation'=>'Длина бумаги чистого тиража, м',
            'length_order'=>'Длина бумаги потраченной на тираж, м',
            'square_clear_circulation'=>'Чистая площадь бумаги тиража, м2',
            'square_order'=>'Площадь бумаги потраченной на тираж, м2',
            'paint_weight'=>'Кол-во краски, кг/тираж',
            'varnish_weight'=>'Кол-во лака, кг/тираж',
            'square_form'=>'Площадь форм, см2',
            'paper_price'=>'Стоимость бумаги, руб',
            'form_price'=>'Стоимость форм, руб',
            'all_form_count'=>'Кол-во всех форм этикетки, шт',
            'order_form_count'=>'Кол-во форм изготовленных для заказа, шт',
            'paint_price'=>'Стоимость краски, руб',
            'foil_price'=>'Стоимость фольги, руб',
            'laminate_price'=>'Стоимость ламината, руб',
            'stencil_price'=>'Стоимость трафарета, руб',
            'varnish_price'=>'Стоимость лака, руб',
            'transport_price'=>'Транспортировка, руб',
            'efficiency_ratio'=>'Коэфициент эффективности',
            'print_time'=>'Время печати, час',
            'enterprise_cost'=>'Разовые затраты',
        ];
    }

    public function calculate(){
        //Список использованных материалов
        $this->material_list=OrderMaterial::find()->joinWith('paperWarehouse')->select(['paper_warehouse.material_id'])
            ->andWhere(['order_material.order_id' => $this->id])->column();

        //фактический тираж
        foreach(FinishedProductsWarehouse::find()->select(['label_in_roll','roll_count'])->where(['order_id'=>$this->id])->all() as $roll){
            $this->actual_circulation+=$roll->label_in_roll*$roll->roll_count;
        }


        //количество всех форм для этикетки
        if($this->label->combinatedForm)
        $this->all_form_count=count($this->label->combinatedForm);
            else
                $this->all_form_count=count($this->label->form);

        //количество форм выведенных для заказа
        $this->order_form_count=count($this->formOrderHistory);

        //Параметры вала
        $shaft=Shaft::findOne($this->label->pants->shaft_id);

        //Параметры штанца
        $pants=Pants::findOne($this->label->pants_id);

        /*Получение параметров станка*/
        $mashine=CalcMashineParamValue::getMashineParam($this->mashine_id);

        /*Получение общих параметров*/
        $common_param=CalcCommonParam::getCommonParam();

        //Длина бумаги чистого тиража
        if($pants->cuts !=0) $this->length_clear_circulation=$shaft->name*($this->actual_circulation/$pants->cuts)/1000;

        //Длина бумаги потраченной на тираж
        foreach(OrderMaterial::find()->joinWith('paperWarehouse.material')->andWhere(['order_id' => $this->id])
                    ->andWhere(['!=','material.material_group_id',[6,8]])->all() as $roll){
            $this->length_order+=$roll->length;
        }

        //Площадь чистого тиража
        $this->square_clear_circulation=$this->length_clear_circulation*$pants->paper_width/1000;

        //Площадь бумаги потраченной на тираж
        foreach(OrderMaterial::find()->joinWith('paperWarehouse.material')
                    ->andWhere(['order_material.order_id' => $this->id])
                    ->andWhere(['!=','material.material_group_id',[6,8]])
                    ->all() as $roll){
            $this->square_order+=$roll->length*$roll->paperWarehouse->width/1000;
        }

        //Стоимость бумаги
        $this->paper_price=$this->square_order*Material::find()->andWhere(['id'=>$this->material_list])
                ->andWhere(['!=','material_group_id' ,[6,8]])
                ->average('price_euro')*$common_param['euro_exchange'];

        //Площадь фольги
        foreach(OrderMaterial::find()->joinWith('paperWarehouse.material')
                    ->andWhere(['order_material.order_id' => $this->id])
                    ->andWhere(['material.material_group_id'=>6])
                    ->all() as $roll){
            $this->square_foil+=$roll->length*$roll->paperWarehouse->width/1000;
        }

        //Стоимость фольги
        $this->foil_price=$this->square_foil*Material::find()->andWhere(['id'=>$this->material_list])
                ->andWhere(['material_group_id' => 6])
                ->average('price_euro')*$common_param['euro_exchange'];


        //Площадь ламинация
        foreach(OrderMaterial::find()->joinWith('paperWarehouse.material')
                    ->andWhere(['order_material.order_id' => $this->id])
                    ->andWhere(['material.material_group_id'=>8])
                    ->all() as $roll){
            $this->square_laminate+=$roll->length*$roll->paperWarehouse->width/1000;
        }

        //Стоимость ламинации
        $this->laminate_price=$this->square_laminate*Material::find()->andWhere(['id'=>$this->material_list])
                ->andWhere(['material_group_id' => 8])
                ->average('price_euro')*$common_param['euro_exchange'];

        //масса Pantone красок
        if(!empty($this->label->combination)){
            //Если этикетка в совмещении то делим вес на количество этикеток в совмещении
            $this->paint_weight = ($this->square_order * $mashine['paint_usage'] +
                    $mashine['lost_paint_compensation']) / count($this->label->combinatedLabel) *
                ( Form::find()->joinWith('pantone')
                    ->where(['pantone.pantone_kind_id'=>[1,2],'combination_id'=>$this->label->combination->combination_id])
                    ->count());
        }
        else{
            $this->paint_weight = ($this->square_order * $mashine['paint_usage'] +
                    $mashine['lost_paint_compensation']) *
                ( Form::find()->joinWith('pantone')
                    ->where(['pantone.pantone_kind_id'=>[1,2],'label_id'=>$this->label_id])
                    ->count());
        }

        //стоимость красок Pantone
        $this->paint_price+=$this->paint_weight*Pantone::find()->select('price_euro')->where(['pantone_kind_id'=>[1,2],'id'=>
                MashinePantone::find()->joinWith('mashine')
                    ->select('mashine_pantone.pantone_id')
                    ->andwhere(['mashine.mashine_type'=>0])->column()])
                ->average('price_euro') * /*средння цена существующих красок*/
            $common_param['euro_exchange'];

        //стоимость краски переменки
        //1.0712 кг/л плотность краски
        if($this->label->variable==1){
            $this->paint_price += $this->actual_circulation * /*Фактический тираж*/
                $this->label->variable_paint_count/100 * /*Расход краски по программе мл/100эт и дополнительно делим на 100 чтобы получить на онду этикетку*/
                1.0712/1000 * /*Плотность краски переводим в кг/мл */
                Pantone::find()->select('price_euro')->where(['pantone_kind_id'=>[1,2],'id'=>
                    MashinePantone::find()->joinWith('mashine')
                        ->select('mashine_pantone.pantone_id')
                        ->andwhere(['mashine.mashine_type'=>2])->column()])
                    ->average('price_euro') * /*средння цена существующих красок*/
                $common_param['euro_exchange'];
        }

        //масса лака.
        if(!empty($this->label->combination)){
            //Если этикетка в совмещении то делим вес на количество этикеток в совмещении
            foreach(Form::find()->joinWith('pantone')
                        ->where(['pantone.pantone_kind_id'=>[4,5],'combination_id'=>$this->label->combination->combination_id])
                        ->all() as $form){
                $this->varnish_weight += $this->square_order * $mashine['varnish_usage'];
            }
            $this->varnish_weight=$this->varnish_weight/count($this->label->combinatedLabel);
        }
        else{
            foreach(Form::find()->joinWith('pantone')
                        ->where(['pantone.pantone_kind_id'=>[4,5],'label_id'=>$this->label_id])
                        ->all() as $form){
                $this->varnish_weight += $this->square_order * $mashine['varnish_usage'];
            }
        }

        //стоимость лака
        $this->varnish_price+=$this->varnish_weight*Pantone::find()->select('price_euro')->where(['pantone_kind_id'=>[4,5],'id'=>
                MashinePantone::find()->joinWith('mashine')
                    ->select('mashine_pantone.pantone_id')
                    ->andwhere(['mashine.mashine_type'=>0])->column()])
                ->average('price_euro') * /*средння цена существующих лаков*/
            $common_param['euro_exchange'];


        //разовые затраты
        foreach(EnterpriseCost::find()->where(['order_id'=>$this->id])->all() as $cost){
            $this->enterprise_cost+=$cost->cost;
        }

        //Стоимость трафаретной сетки
        if($this->label->stencil==1) $this->stencil_price += $mashine['stencil_mesh_price'];


        //площадь одной формы
        $one_square_form = (2 * $common_param['form_tolerance'] + $pants->paper_width ) *
            (2 * $common_param['form_tolerance'] + $shaft->name)/100;

        //площадь форм изготовленных для заказа
        $this->square_form=$one_square_form*$this->order_form_count;

        //стоимость форм изготовленных для заказа
        $this->form_price=$this->square_form*$mashine['form_price']*$common_param['euro_exchange'];


        //получаем вес заказа с коробками которые были отправлены
        foreach($this->finishedProductsWarehouse as $roll){
            $this->order_weight+=$roll->sended_roll_count*$roll->label_in_roll*$common_param['one_label_weight'];
            $this->order_weight+=$roll->sended_box_count*$common_param['one_box_weight'];
        }

        //находим стоимость транспортировки всей отгрузки в которой был заказ


        //находим стоимость транспортировки заказ
        if($this->shipment->shipmentWeight !=0 )
        $this->transport_price=$this->order_weight/$this->shipment->shipmentWeight*($this->shipment->gasoline_cost+$this->shipment->cost);
    }
}