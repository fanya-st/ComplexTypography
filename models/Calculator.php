<?php


namespace app\models;


use yii\base\Model;

class Calculator extends Model
{
    public $mashine_id;
    public $variable_mashine_id;
    public $material_id;
    public $circulation;
    public $pants_id;
    public $foil_width;
    public $holo_foil_width;
    public $laminate_width;
    public $cmyk_count;
    public $pantone_count;
    public $mixed_pantone_count;
    public $glossy_varnish;
    public $matte_varnish;
    public $print_on_glue;
    public $book;
    public $variable;
    public $variable_paint_count;
    public $original_paint_selection;
    public $stencil;
    public $stencil_mesh;
    public $stencil_mesh_filling;
    public $price_increase;
    public $layout;
    public $stamping;
    public $other_cost;
    public $combinated_label;
    public $exchangeable_form_count;
    public $form_price;
    public $calculated_paper_price;
    public $calculated_paper_length_common;
    public $calculated_square_paper_common;
    public $calculated_time_common;
    public $calculated_time_adjust;
    public $calculated_time_print;
    public $calculated_foil_price;
    public $calculated_material_price;
    public $calculated_job_price;
    public $calculated_form_price;
    public $calculated_scotch_price;
    public $calculated_foil_holo_price;
    public $calculated_matte_varnish_price;
    public $calculated_glossy_varnish_price;
    public $calculated_laminate_price;
    public $calculated_paint_price;
    public $calculated_variable_paint_price;
    public $calculated_label_price;
    public $calculated_label_price_tax;
    public $calculated_circulation_price;
    public $calculated_circulation_price_tax;

    public function attributeLabels()
    {
        return [
            'mashine_id'=>'Станок',
            'variable_mashine_id'=>'Станок переменной печати',
            'pants_id'=>'Штанец',
            'material_id'=>'Материал',
            'circulation'=>'Тираж',
            'foil_width'=>'Ширина фольги, мм',
            'holo_foil_width'=>'Ширина гологр-й фольги, мм',
            'laminate_width'=>'Ширина ламинации, мм',
            'cmyk_count'=>'Количество красок CMYK',
            'pantone_count'=>'Количество красок Pantone',
            'mixed_pantone_count'=>'Количество смешанных Pantone',
            'original_paint_selection'=>'Подбор краски под оригинал',
            'variable_paint_count'=>'Количество краски переменки на 100 эт., мл',
            'variable'=>'Переменная печать',
            'glossy_varnish'=>'Покрытие глянцевым лаком',
            'matte_varnish'=>'Покрытие матовым лаком',
            'print_on_glue'=>'Печать по клею',
            'book'=>'Печать этикетки книжки',
            'stamping'=>'Конгрев',
            'stencil'=>'Трафарет',
            'stencil_mesh'=>'Стоимость трафаретной сетки',
            'stencil_mesh_filling'=>'Заполнение краской трафарета, %',
            'price_increase'=>'С учетом повышения цен',
            'layout'=>'Стоимость верстки',
            'other_cost'=>'Прочие расходы, руб/тираж',
            'combinated_label'=>'Количество совмещенных этикеток',
            'form_price'=>'Стоимость форм',
            'exchangeable_form_count'=>'Количество сменных форм',
        ];
    }

    public function rules(){
        return[
            [['mashine_id','variable_mashine_id','pants_id','exchangeable_form_count','combinated_label','other_cost','stamping','layout','price_increase','stencil_mesh_filling',
               'stencil_mesh','stencil','original_paint_selection','variable_paint_count','variable','book','print_on_glue','matte_varnish','glossy_varnish',
                'mixed_pantone_count','pantone_count','cmyk_count','laminate_width','holo_foil_width','foil_width','circulation','material_id','form_price',
                'calculated_label_price','calculated_label_price_tax','calculated_label_price','calculated_label_price_tax'
                ],'safe'],
            [['pants_id','material_id','mashine_id','variable_mashine_id',],'integer'],
            [['cmyk_count','pantone_count','mixed_pantone_count','variable_paint_count','stencil_mesh_filling'], 'default', 'value' => 0],
            [['mashine_id','variable_mashine_id','circulation'], 'required'],
        ];
    }

    public function calculate($pants){
        /*Параметры штанца*/

        $pants_param=Pants::findOne($this->pants_id);

        /*Параметры вала*/

        $shaft_param=Shaft::findOne($pants->shaft_id);

        /*Получение параметров станка*/
        $mashine_param=CalcMashineParamValue::getMashineParam($this->mashine_id);

        if($this->variable)
            $variable_mashine_param=CalcMashineParamValue::getMashineParam($this->variable_mashine_id);

        /*Получение общих параметров*/
        $common_param=CalcCommonParam::getCommonParam();


        /*Длина бумаги чистого тиража*/
        if($pants->cuts !=0) $paper_length_clear_circulation=$shaft_param->name*($this->circulation/$pants->cuts)/1000;


        /*Количество бумаги на настройку*/
        $paper_length_adjust=$mashine_param['paper_common_adjust']+$mashine_param['paper_cmyk_adjust'] * ($this->cmyk_count+$this->pantone_count)
            +$mashine_param['paper_pantone_adjust']*$this->mixed_pantone_count;

        /*количество сменяемых роликов*/
        $roll_count= floor($paper_length_clear_circulation/$mashine_param['roll_change_length']);

        /*бумага на смену роликов*/
        $paper_length_adjust+=$mashine_param['paper_roll_change']*$roll_count;


        if($this->matte_varnish) $paper_length_adjust+=$mashine_param['paper_varnish_adjust'];
        if($this->glossy_varnish) $paper_length_adjust+=$mashine_param['paper_varnish_adjust'];
        if($this->stencil) $paper_length_adjust+=$mashine_param['paper_cmyk_adjust'];
        if($this->original_paint_selection) $paper_length_adjust+=$mashine_param['paper_paint_selection_adjust'];
        if($this->variable) $paper_length_adjust+=$variable_mashine_param['paper_common_adjust'];

        //Печать по клею

        if($this->print_on_glue) $paper_length_adjust+=$paper_length_adjust*$common_param['print_on_glue'];

        if($this->print_on_glue) $paper_length_clear_circulation+=$paper_length_clear_circulation*$common_param['print_on_glue'];

        //печать книжки

        if ($this->book) $paper_length_adjust+=$paper_length_adjust*$common_param['print_label_book'];

        if ($this->book) $paper_length_clear_circulation+=$paper_length_clear_circulation*$common_param['print_label_book'];



        /*Площадь чистого тиража*/

        $square_length_clear_circulation=$paper_length_clear_circulation*$pants->paper_width/1000;



        /*Длина бумаги общая*/
        $this->calculated_paper_length_common=$paper_length_clear_circulation+$paper_length_adjust;
        $paper_length_common=$this->calculated_paper_length_common;

        /*Площадь бумаги общая*/
        $this->calculated_square_paper_common=$paper_length_common * $pants->paper_width/1000;
        $square_paper_common=$this->calculated_square_paper_common;

        /*Площадь фольги общая*/

        if ($this->foil_width) $square_foil_common = $paper_length_common * $this->foil_width / 1000;
        if ($this->holo_foil_width) $square_foil_holo_common = $paper_length_common * $this->holo_foil_width / 1000;
        if ($this->laminate_width) $square_laminate_common = $paper_length_common * $this->laminate_width / 1000;

        //время настройки
        $time_adjust = $mashine_param['common_adjust'] +($mashine_param['time_cmyk_adjust'] * ( $this->cmyk_count+$this->pantone_count)
                + $mashine_param['time_pantone_adjust'] * $this->mixed_pantone_count)+
            $mashine_param['one_roll_change_time']*$roll_count/60;
        if($this->stamping)
            $time_adjust+=$common_param['stamping_time'];
        if($this->variable)
            $time_adjust+=$variable_mashine_param['common_adjust'];
        if($this->combinated_label)
            $time_adjust+=$common_param['form_change_time'] * $this->exchangeable_form_count * ( $this->combinated_label - 1 )/60;
        if($this->glossy_varnish) $time_adjust+= $mashine_param['time_varnish_adjust'];
        if($this->matte_varnish) $time_adjust+= $mashine_param['time_varnish_adjust'];
        if( $this->stencil) $time_adjust+= $mashine_param['time_stencil_mesh_adjust'];
        if( $this->original_paint_selection ) $time_adjust+= $mashine_param['time_paint_selection'];

        //время печати
        if ($mashine_param['print_speed'])
            $time_print = $paper_length_common / ( $mashine_param['print_speed'] * 60);
        else
            $time_print =  $paper_length_common / ( 600);

        //общее время
        $this->calculated_time_common=$time_print + $time_adjust ;
        $this->calculated_time_print=$time_print;
        $this->calculated_time_adjust=$time_adjust;
        $time_common = $this->calculated_time_common;


        //стоимость материала

        //стоимость бумаги
        $this->calculated_paper_price=$square_paper_common * Material::findOne($this->material_id)->price_euro*$common_param['euro_exchange'];
        $material_price += $this->calculated_paper_price;

        //стоимость фольги и ламинации
        $this->calculated_foil_price=$square_foil_common * Material::find()->where(['material_group_id'=>6])->orderBy(['price_euro'=>SORT_DESC])->one()->price_euro
            * $common_param['euro_exchange'] ;
        $material_price+= $this->calculated_foil_price;

        $this->calculated_foil_holo_price=$square_foil_holo_common * Material::find()->where(['material_group_id'=>6])->orderBy(['price_euro'=>SORT_DESC])->one()->price_euro
            * $common_param['euro_exchange'] ;
        $material_price+= $this->calculated_foil_holo_price;

        $this->calculated_laminate_price=$square_laminate_common * Material::find()->where(['material_group_id'=>8])->orderBy(['price_euro'=>SORT_DESC])->one()->price_euro
            * $common_param['euro_exchange'];
        $material_price+=$this->calculated_laminate_price;


        //площадь одной формы
        $square_form = (2 * $common_param['form_tolerance'] + $pants->paper_width ) * (2 * $common_param['form_tolerance'] + $shaft_param->name)/100;

        //площадь всех форм

        $square_form_common = $square_form * ( $this->cmyk_count+$this->pantone_count + $this->mixed_pantone_count );
        if($this->combinated_label)
            $square_form_common+=( $this->combinated_label - 1 ) * $this->exchangeable_form_count * $square_form ;

        if($this->glossy_varnish) $square_form_common+= $square_form;
        if($this->matte_varnish) $square_form_common+= $square_form;

        /*Стоимость форм*/
        $this->calculated_form_price=$square_form_common * $mashine_param['form_price']*$common_param['euro_exchange'];
//        $material_price+=$this->calculated_form_price;

        //масса краски
        $weight_paint = ($square_paper_common * $mashine_param['paint_usage'] + $mashine_param['lost_paint_compensation'])
            * ( $this->cmyk_count+ $this->pantone_count + $this->mixed_pantone_count );

        if($this->combinated_label)
            $weight_paint+=$mashine_param['lost_paint_compensation'] * ( $this->combinated_label - 1 ) * $this->exchangeable_form_count;

        if($this->stencil )
            $weight_paint+= ( $square_paper_common * $mashine_param['stencil_paint_usage'] + $mashine_param['lost_paint_compensation'] )
                * $this->stencil_mesh_filling/100;

        //масса лака.
        if($this->matte_varnish) $weight_matte_varnish = ($square_paper_common * $mashine_param['varnish_usage'] );
        if($this->glossy_varnish) $weight_glossy_varnish = ($square_paper_common * $mashine_param['varnish_usage'] );

        //стоимость лака
        if($this->matte_varnish) {
            $this->calculated_matte_varnish_price = $weight_matte_varnish * Pantone::find()->select('price_euro')->where(['pantone_kind_id'=>4,'id'=>MashinePantone::find()
                    ->select('pantone_id')->where(['mashine_id'=>$this->mashine_id])->column()])
                    ->average('price_euro') /*средння цена существующих матовых лаков*/ * $common_param['euro_exchange'];
            $material_price += $this->calculated_matte_varnish_price;
        }
        if($this->glossy_varnish) {
            $this->calculated_glossy_varnish_price = $weight_glossy_varnish * Pantone::find()->select('price_euro')->where(['pantone_kind_id'=>5,'id'=>MashinePantone::find()
                    ->select('pantone_id')->where(['mashine_id'=>$this->mashine_id])->column()])
                    ->average('price_euro') /*средння цена существующих глянцевых лаков*/ * $common_param['euro_exchange'] ;
            $material_price+= $this->calculated_glossy_varnish_price;
        }

        //стоимость краски

        $this->calculated_paint_price = $weight_paint *
            Pantone::find()->select('price_euro')->where(['pantone_kind_id'=>[1,2],'id'=>MashinePantone::find()
                ->select('pantone_id')->where(['mashine_id'=>$this->mashine_id])->column()])
                ->average('price_euro') /*средння цена существующих красок*/ * $common_param['euro_exchange'];
        $material_price += $this->calculated_paint_price;


        //стоимость краски переменки
        if($this->variable){
            $this->calculated_variable_paint_price = ( $pants->cuts * ($this->variable_paint_count * 1.0712/1000 * $common_param['euro_exchange']
                        * (Pantone::find()->select('price_euro')->where(['pantone_kind_id'=>[1,2],'id'=>MashinePantone::find()
                            ->select('pantone_id')->where(['mashine_id'=>$this->variable_mashine_id])->column()])
                            ->average('price_euro') /*средння цена существующих красок*/)) / 100)/
                (($pants->paper_width * $shaft_param->name)/1000) * $square_paper_common*1000;
            $material_price +=$this->calculated_variable_paint_price;
        }

        //стоимость скотча
        $this->calculated_scotch_price=$square_form_common * $mashine_param['scotch_price'] + ( 0.03 * $this->circulation );
        $material_price += $this->calculated_scotch_price;


        //стоимость трафаретной сетки
        if($this->stencil_mesh ) $material_price += $mashine_param['stencil_mesh_price'];

        //стоимость рабочего времени
        $job_price = $time_common * $common_param['desired_profit']* $common_param['euro_exchange'];

        if($this->variable){
            $job_price += $time_common * $variable_mashine_param['desired_profit']* $common_param['euro_exchange'];
        }

        if($this->form_price ) $material_price += $this->calculated_form_price;

        //С учетом повышения цен
        if($this->price_increase) $material_price += $material_price  * $common_param['price_increase'];

        //себестоимость тиража материальная
        $this->calculated_material_price=$material_price;
        $this->calculated_job_price=$job_price;

        $circulation_price = $this->calculated_material_price + $this->calculated_job_price;

        if($this->original_paint_selection) $circulation_price += $mashine_param['paint_selection_price'] ;
        if($this->layout) $circulation_price += $mashine_param['design_layout_price'] ;
        if($this->other_cost) $circulation_price += $this->other_cost ;

        //цена одной этикетки
            $label_price = $circulation_price / $this->circulation;

        $circulation_price_tax = $circulation_price * (1 + $common_param['tax'] /100);
        $label_price_tax = $label_price * (1 + $common_param['tax'] /100);

        $this->calculated_label_price=$label_price;
        $this->calculated_label_price_tax=$label_price_tax;
        $this->calculated_circulation_price=$circulation_price;
        $this->calculated_circulation_price_tax=$circulation_price_tax;
    }
}

