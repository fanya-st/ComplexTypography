<?php


namespace app\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
    public $square_all_form;
    public $paper_price;
    public $paint_price;
    public $varnish_price;
    public $form_price;
    public $scotch_price;
    public $laminate_price;
    public $foil_price;
    public $all_form_count;
    public $order_form_count;
    public $stencil_price;
    public $transport_price;
    public $circulation_price;
    public $efficiency_ratio;
    public $order_time;
    public $print_time;
    public $enterprise_cost;
    public $one_label_material_price;
    public $order_send_price;
    public $order_income;
    public $com_coef;


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
            'square_form'=>'Площадь форм изготовленных для заказа, см2',
            'square_all_form'=>'Площадь всех форм, см2',
            'paper_price'=>'Стоимость бумаги, руб',
            'form_price'=>'Стоимость форм, руб',
            'all_form_count'=>'Кол-во всех форм этикетки, шт',
            'order_form_count'=>'Кол-во форм изготовленных для заказа, шт',
            'paint_price'=>'Стоимость краски, руб',
            'foil_price'=>'Стоимость фольги, руб',
            'laminate_price'=>'Стоимость ламината, руб',
            'stencil_price'=>'Стоимость трафарета, руб',
            'varnish_price'=>'Стоимость лака, руб',
            'scotch_price'=>'Стоимость скотча, руб',
            'circulation_price'=>'Себестоимость тиража, руб',
            'transport_price'=>'Транспортировка, руб',
            'efficiency_ratio'=>'Коэфициент эффективности',
            'order_time'=>'Время заказа, час',
            'print_time'=>'Время печати, час',
            'enterprise_cost'=>'Разовые затраты',
            'one_label_material_price'=>'Стоимость материалов для этикетки, руб',
            'order_send_price'=>'Стоимость по отправке с НДС, руб',
            'order_income'=>'Доход по отправке, руб',
            'com_coef'=>'Коэффициент совместной печати',
        ];
    }

    public function calculate(){
        //Список использованных материалов
        if(!empty($this->getCombinatedPrintOrder())){
            //Если заказ печатается совместно то
            $this->material_list=OrderMaterial::find()->joinWith('paperWarehouse')->select(['paper_warehouse.material_id'])
                ->andWhere(['order_material.order_id' => Order::find()->select('id')->where(['label_id'=>$this->label->combinatedLabel])->column()])->column();
        }else{
            $this->material_list=OrderMaterial::find()->joinWith('paperWarehouse')->select(['paper_warehouse.material_id'])
                ->andWhere(['order_material.order_id' => $this->id])->column();
        }


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

        /*Получение курса евро в этот период*/
        $euro_exchange=CalcCommonParamArchive::getCommonParamArchive($this->date_of_print_begin,'euro_exchange');

        //Совместная печать коэффициент
        if(!empty($this->getCombinatedPrintOrder())){
            //Если заказ печатается совместно то найдем коэфициент совместной печати
            foreach($this->getCombinatedPrintOrder() as $o){
                $all_plan_circulation+=$o->plan_circulation;
            }
            $this->com_coef=$this->plan_circulation/$all_plan_circulation;
        }

        //Длина бумаги чистого тиража
        if($pants->cuts !=0) $this->length_clear_circulation=$shaft->name*($this->actual_circulation/$pants->cuts)/1000;

        //Длина и площадь бумаги потраченной на тираж
        if($this->com_coef != 0){
            //Если заказ печатается совместно
            foreach(OrderMaterial::find()->joinWith('paperWarehouse.material')->andWhere(['order_id' => Order::find()->select('id')->where(['label_id'=>$this->label->combinatedLabel])->column()])
                        ->andWhere(['!=','material.material_group_id',[6,8]])->all() as $roll){
                $this->length_order+=$roll->length;
                $this->square_order+=$roll->length*$roll->paperWarehouse->width/1000;
            }
            $this->square_order*=$this->com_coef;
        }else{
            foreach(OrderMaterial::find()->joinWith('paperWarehouse.material')->andWhere(['order_id' => $this->id])
                        ->andWhere(['!=','material.material_group_id',[6,8]])->all() as $roll){
                $this->length_order+=$roll->length;
                $this->square_order+=$roll->length*$roll->paperWarehouse->width/1000;
            }
        }


        //Площадь чистого тиража
        $this->square_clear_circulation=$this->length_clear_circulation*$pants->paper_width/1000;
        if(!empty($this->сombinatedPrintOrder)){
            //Если заказ печатается совместно
            $this->square_clear_circulation=$this->com_coef*$this->square_clear_circulation;
        }


        //Стоимость бумаги
        if(!empty($this->square_order))
        $this->paper_price=$this->square_order
            *MaterialPriceArchive::getPriceAverage($this->material_list,$this->date_of_print_begin,[6,8],null)
            *$euro_exchange;

        //Площадь фольги
        if($this->com_coef != 0){
            //Если заказ печатается совместно
            foreach(OrderMaterial::find()->joinWith('paperWarehouse.material')->andWhere(['order_id' => Order::find()->select('id')->where(['label_id'=>$this->label->combinatedLabel])->column()])
                        ->andWhere(['material.material_group_id'=>6])->all() as $roll){
                $this->square_foil+=$roll->length*$roll->paperWarehouse->width/1000;
            }
            $this->square_foil*=$this->com_coef;
        }else{
            foreach(OrderMaterial::find()->joinWith('paperWarehouse.material')
                        ->andWhere(['order_material.order_id' => $this->id])
                        ->andWhere(['material.material_group_id'=>6])
                        ->all() as $roll){
                $this->square_foil+=$roll->length*$roll->paperWarehouse->width/1000;
            }
        }


        //Стоимость фольги
        if(!empty($this->square_foil))
        $this->foil_price=$this->square_foil
            *MaterialPriceArchive::getPriceAverage($this->material_list,$this->date_of_print_begin,null,6)
            *$euro_exchange;


        //Площадь ламинация
        if($this->com_coef != 0){
            //Если заказ печатается совместно
            foreach(OrderMaterial::find()->joinWith('paperWarehouse.material')->andWhere(['order_id' => Order::find()->select('id')->where(['label_id'=>$this->label->combinatedLabel])->column()])
                        ->andWhere(['material.material_group_id'=>8])->all() as $roll){
                $this->square_laminate+=$roll->length*$roll->paperWarehouse->width/1000;
            }
            $this->square_laminate*=$this->com_coef;

        }else{
            foreach(OrderMaterial::find()->joinWith('paperWarehouse.material')
                        ->andWhere(['order_material.order_id' => $this->id])
                        ->andWhere(['material.material_group_id'=>8])
                        ->all() as $roll){
                $this->square_laminate+=$roll->length*$roll->paperWarehouse->width/1000;
            }
        }

        //Стоимость ламинации
        if(!empty($this->square_laminate))
        $this->laminate_price=$this->square_laminate
            *MaterialPriceArchive::getPriceAverage($this->material_list,$this->date_of_print_begin,null,8)
            *$euro_exchange;

        //масса Pantone красок
        if(!empty($this->label->combination)){
            //Если этикетка в совмещении то делим вес на количество этикеток в совмещении
            $this->paint_weight = ($this->square_order * CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'paint_usage') +
                    CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'lost_paint_compensation'))  *
                ( Form::find()->joinWith('pantone')
                    ->where(['pantone.pantone_kind_id'=>[1,2],'combination_id'=>$this->label->combination->combination_id])
                    ->count());
        }
        else{
            $this->paint_weight = ($this->square_order * CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'paint_usage') +
                    CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'lost_paint_compensation')) *
                ( Form::find()->joinWith('pantone')
                    ->where(['pantone.pantone_kind_id'=>[1,2],'label_id'=>$this->label_id])
                    ->count());
        }

        //стоимость красок Pantone
        $this->paint_price+=$this->paint_weight
//            *Pantone::find()->select('price_euro')->where(['pantone_kind_id'=>[1,2],'id'=>
//                MashinePantone::find()->joinWith('mashine')
//                    ->select('mashine_pantone.pantone_id')
//                    ->andwhere(['mashine.mashine_type'=>0])->column()])
//                ->average('price_euro') /*средння цена существующих красок*/
            *PantonePriceArchive::getPriceAverage($this->date_of_print_begin,[1,2],$this->mashine_id,0)
            *$euro_exchange;

        //стоимость краски переменки
        //1.0712 кг/л плотность краски
        if($this->label->variable==1){
            $this->paint_price += $this->actual_circulation * /*Фактический тираж*/
                $this->label->variable_paint_count/100 * /*Расход краски по программе мл/100эт и дополнительно делим на 100 чтобы получить на онду этикетку*/
                1.0712/1000 /*Плотность краски переводим в кг/мл */
//                Pantone::find()->select('price_euro')->where(['pantone_kind_id'=>[1,2],'id'=>
//                    MashinePantone::find()->joinWith('mashine')
//                        ->select('mashine_pantone.pantone_id')
//                        ->andwhere(['mashine.mashine_type'=>2])->column()])
//                    ->average('price_euro') * /*средння цена существующих красок*/
                *PantonePriceArchive::getPriceAverage($this->date_of_print_begin,[1,2],null,2)
                *$euro_exchange;
        }

        //масса лака.
        if(!empty($this->label->combination)){
            //Если этикетка в совмещении то делим вес на количество этикеток в совмещении
            foreach(Form::find()->joinWith('pantone')
                        ->where(['pantone.pantone_kind_id'=>[4,5],'combination_id'=>$this->label->combination->combination_id])
                        ->all() as $form){
                $this->varnish_weight += $this->square_order * CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'varnish_usage');
            }
        }
        else{
            foreach(Form::find()->joinWith('pantone')
                        ->where(['pantone.pantone_kind_id'=>[4,5],'label_id'=>$this->label_id])
                        ->all() as $form){
                $this->varnish_weight += $this->square_order * CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'varnish_usage');
            }
        }

        //стоимость лака
        $this->varnish_price+=$this->varnish_weight
//            *Pantone::find()->select('price_euro')->where(['pantone_kind_id'=>[4,5],'id'=>
//                MashinePantone::find()->joinWith('mashine')
//                    ->select('mashine_pantone.pantone_id')
//                    ->andwhere(['mashine.mashine_type'=>0])->column()])
//                ->average('price_euro') * /*средння цена существующих лаков*/
            *PantonePriceArchive::getPriceAverage($this->date_of_print_begin,[4,5],$this->mashine_id,0)
            *$euro_exchange;


        //разовые затраты
        foreach(EnterpriseCost::find()->where(['order_id'=>$this->id])->all() as $cost){
            $this->enterprise_cost+=$cost->cost;
        }

        //Стоимость трафаретной сетки
        if($this->label->stencil==1) $this->stencil_price += CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'stencil_mesh_price');
        if($this->com_coef != 0){
            //Если заказ печатается совместно
            $this->stencil_price*=$this->com_coef;
        }


        //площадь одной формы
        $one_square_form = (2 * CalcCommonParamArchive::getCommonParamArchive($this->date_of_print_begin,'form_tolerance') + $pants->paper_width ) *
            (2 * CalcCommonParamArchive::getCommonParamArchive($this->date_of_print_begin,'form_tolerance') + $shaft->name)/100;

        //площадь форм изготовленных для заказа
        $this->square_form=$one_square_form*$this->order_form_count;
        if($this->com_coef != 0){
            //Если заказ печатается совместно
            $this->square_form*=$this->com_coef;
        }

        //площадь форм использованных в заказе
        $this->square_all_form=$one_square_form*$this->all_form_count;
        if($this->com_coef != 0){
            //Если заказ печатается совместно
            $this->square_all_form*=$this->com_coef;
        }

        //стоимость форм изготовленных для заказа
        $this->form_price=$this->square_form*CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'form_price')*$euro_exchange;


        //получаем вес заказа с коробками которые были отправлены
        foreach($this->finishedProductsWarehouse as $roll){
            $this->order_weight+=$roll->sended_roll_count*$roll->label_in_roll*CalcCommonParamArchive::getCommonParamArchive($this->date_of_print_begin,'one_label_weight');
            $this->order_weight+=$roll->sended_box_count*CalcCommonParamArchive::getCommonParamArchive($this->date_of_print_begin,'one_box_weight');
        }

        //стоимость скотча
        //находим количество использованных секций, она равна количеству использованных форм
        if(!empty($this->label->combination)){
            //Если этикетка в совмещении то
            $used_sections=count(Form::find()->joinWith('pantone')
                        ->where(['combination_id'=>$this->label->combination->combination_id])
                        ->all());
            $used_sections*=$this->com_coef;
        }
        else{
            $used_sections=count(Form::find()->joinWith('pantone')
                        ->where(['label_id'=>$this->label_id])
                        ->all());
        }
        $this->scotch_price += ($this->square_all_form * $used_sections * CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'scotch_price')+ CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'scotch_price')/32 * $this->actual_circulation)*$euro_exchange;


        //находим стоимость транспортировки всей отгрузки в которой был заказ
        //находим стоимость транспортировки заказа
        if($this->shipment->shipmentWeight !=0 )
        $this->transport_price=$this->order_weight/$this->shipment->shipmentWeight*($this->shipment->gasoline_cost+$this->shipment->cost);

        //стоимость материалов потраченных на заказ
        $this->circulation_price+=$this->paper_price;
        $this->circulation_price+=$this->form_price;
        $this->circulation_price+=$this->scotch_price;
        $this->circulation_price+=$this->stencil_price;
        $this->circulation_price+=$this->varnish_price;
        $this->circulation_price+=$this->paint_price;
        $this->circulation_price+=$this->laminate_price;
        $this->circulation_price+=$this->foil_price;
        $this->circulation_price+=$this->paper_price;
        $this->circulation_price+=$this->transport_price;

        //длительность печати
        $print_time=date_diff(date_create($this->date_of_print_begin),date_create($this->date_of_print_end));
        $this->print_time=$print_time->h+24* $print_time->days+$print_time->i/60+$print_time->s/3600;


        //длительность заказа
            if(empty($this->shipment->date_of_send))
                $order_time=date_diff(date_create($this->date_of_print_begin),date_create($this->shipment->date_of_send));
            else
                $order_time=date_diff(date_create($this->date_of_print_begin),date_create());
            $this->order_time=$order_time->h+24* $order_time->days+$order_time->i/60+$order_time->s/3600;


        //стоимость материалов одной этикетки
        $this->one_label_material_price=$this->circulation_price/$this->actual_circulation;

        //сумма заказа по отправке с ндс
        if(!empty($this->shipment) && $this->shipment->status_id==2)
        $this->order_send_price=$this->circulationCountSend*$this->label_price_with_tax;

        //доход
        $this->order_income=$this->order_send_price-$this->circulation_price;

        //коэффициент эффективности
        if($this->order_time*CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'desired_profit')*$euro_exchange!=0)
        $this->efficiency_ratio=$this->order_income/($this->order_time*CalcMashineParamValueArchive::getMashineParamArchive($this->mashine_id,$this->date_of_print_begin,'desired_profit')*$euro_exchange);


    }

    public function excel($orders,$searchModel){
        //Создаем экземпляр класса электронной таблицы
                $spreadsheet = new Spreadsheet();
                //Получаем текущий активный лист
                $sheet = $spreadsheet->getActiveSheet();
                // Записываем в ячейку A1 данные
                $sheet->setCellValue('A1', 'Финансовый отчет с '.$searchModel->date_of_print_start.' по '.$searchModel->date_of_print_end);
                $sheet->mergeCells('A1:E1');
                $sheet->setCellValue('A2', 'Станок');
                $sheet->setCellValue('B2', 'Дата конца печати');
                $sheet->setCellValue('C2', 'Менеджер');
                $sheet->setCellValue('D2', 'Заказчик');
                $sheet->setCellValue('E2', 'Заказ №');
                $sheet->setCellValue('F2', 'Этикетка');
                $sheet->setCellValue('G2', 'Тираж план, шт');
                $sheet->setCellValue('H2', 'Отправка, шт');
                $sheet->setCellValue('I2', 'Факт тираж, шт');
                $sheet->setCellValue('J2', 'Штанец №');
                $sheet->setCellValue('K2', 'Этикетка Ш, мм');
                $sheet->setCellValue('L2', 'Этикетка В, мм');
                $sheet->setCellValue('M2', 'Вал, мм');
                $sheet->setCellValue('N2', 'Всего форм, шт');
                $sheet->setCellValue('O2', 'Форм для заказа, шт');
                $sheet->setCellValue('P2', '');
                $sheet->setCellValue('Q2', 'Площадь бумаги на заказ, м2');
                $sheet->setCellValue('R2', 'Чистая площадь тиража, м2');
                $sheet->setCellValue('S2', 'Кол-во краски, кг');
                $sheet->setCellValue('T2', 'Стоимость бумаги, руб');
                $sheet->setCellValue('U2', 'Стоимость форм, руб');
                $sheet->setCellValue('V2', 'Стоимость красок, руб');
                $sheet->setCellValue('W2', 'Стоимость лака, руб');
                $sheet->setCellValue('X2', 'Стоимость фольги, руб');
                $sheet->setCellValue('Y2', 'Стоимость ламината, руб');
                $sheet->setCellValue('Z2', 'Стоимость трафарета, руб');
                $sheet->setCellValue('AA2', 'Разовые затраты, руб');
                $sheet->setCellValue('AB2', 'Транспортировка, руб');
                $sheet->setCellValue('AC2', 'Себестоимость этикетки, руб');
                $sheet->setCellValue('AD2', 'Цена этикетки НДС, руб');
                $sheet->setCellValue('AE2', 'Факт. отправлено, шт');
                $sheet->setCellValue('AF2', 'Себестоимость тиража, руб');
                $sheet->setCellValue('AG2', 'Коэфициент эффективности');
                $sheet->setCellValue('AH2', 'Доход, руб');
                $row=3;
                foreach($orders as $order){
                    $sheet->setCellValue('A'.$row, $order->mashine->name);
                    $sheet->setCellValue('B'.$row, $order->date_of_print_end);
                    $sheet->setCellValue('C'.$row, User::getFullNameByUsername($order->label->customer->manager_login));
                    $sheet->setCellValue('D'.$row, $order->label->customer->name);
                    $sheet->setCellValue('E'.$row, $order->id);
                    $sheet->setCellValue('F'.$row, $order->label_id);
                    $sheet->setCellValue('G'.$row, $order->plan_circulation);
                    $sheet->setCellValue('H'.$row, $order->sending);
                    $sheet->setCellValue('I'.$row, $order->actual_circulation);
                    $sheet->setCellValue('J'.$row, $order->label->pants_id);
                    $sheet->setCellValue('K'.$row, $order->label->pants->width_label);
                    $sheet->setCellValue('L'.$row, $order->label->pants->height_label);
                    $sheet->setCellValue('M'.$row, $order->label->pants->shaft->name);
                    $sheet->setCellValue('N'.$row, $order->all_form_count);
                    $sheet->setCellValue('O'.$row, $order->order_form_count);
                    $sheet->setCellValue('P'.$row, '');
                    $sheet->setCellValue('Q'.$row, round($order->square_order,2));
                    $sheet->setCellValue('R'.$row, round($order->square_clear_circulation,2));
                    $sheet->setCellValue('S'.$row, round($order->paint_weight,2));
                    $sheet->setCellValue('T'.$row, round($order->paper_price,2));
                    $sheet->setCellValue('U'.$row, round($order->form_price,2));
                    $sheet->setCellValue('V'.$row, round($order->paint_price,2));
                    $sheet->setCellValue('W'.$row, round($order->varnish_price,2));
                    $sheet->setCellValue('X'.$row, round($order->foil_price,2));
                    $sheet->setCellValue('Y'.$row, round($order->laminate_price,2));
                    $sheet->setCellValue('Z'.$row, round($order->stencil_price,2));
                    $sheet->setCellValue('AA'.$row, round($order->enterprise_cost,2));
                    $sheet->setCellValue('AB'.$row, round($order->transport_price,2));
                    $sheet->setCellValue('AC'.$row, round($order->one_label_material_price,2));
                    $sheet->setCellValue('AD'.$row, round($order->label_price_with_tax,2));
                    $sheet->setCellValue('AE'.$row, $order->circulationCountSend);
                    $sheet->setCellValue('AF'.$row, round($order->circulation_price,2));
                    $sheet->setCellValue('AG'.$row, round($order->efficiency_ratio,3));
                    $sheet->setCellValue('AH'.$row, round($order->order_income,2));
                    $row++;
                }

                $extension = 'Xlsx';
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $extension);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header("Content-Disposition: attachment; filename=\"fin_report.{$extension}\"");
                $writer->save('php://output');
                exit();
    }
}