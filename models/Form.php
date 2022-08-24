<?php


namespace app\models;


use yii\db\ActiveRecord;

class Form extends ActiveRecord
{
    public $form_defect_id_temp;
    public $set_form_count;
    public function getPhotoOutput(){
        return $this->hasOne(PhotoOutput::class,['id'=>'photo_output_id']);
    }
    public function getFormDefect(){
        return $this->hasOne(FormDefect::class,['id'=>'form_defect_id']);
    }
    public function getPantone(){
        return $this->hasOne(Pantone::class,['id'=>'pantone_id']);
    }
    public function getEnvelope(){
        return $this->hasOne(Envelope::class,['id'=>'envelope_id']);
    }

    public function getPantoneName(){
        if (isset($this->pantone))
            return $this->pantone->name;
            elseif($this->stencil_form!=0) return 'Трафаретная форма';
            elseif($this->varnish_form!=0) return 'Лаковая форма';
            elseif($this->foil_form!=0) return 'Фольга';
    }

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'polymer_id'=>'Полимер',
            'envelope_id'=>'Конверт',
            'pantone_id'=>'Пантон',
            'width'=>'Ширина, мм',
            'height'=>'Высота, мм',
            'lpi'=>'Линиатура',
            'dpi'=>'Разрешение',
            'photoOutput.name'=>'Фотовывод',
            'photo_output_id'=>'Фотовывод',
            'pantoneName'=>'Пантон',
            'stencil_form'=>'Трафарет',
            'foil_form'=>'Фольга',
            'varnish_form'=>'Лаковая форма',
            'set_form_count'=>'Количество форм',
        ];
    }

    public function rules(){
        return[
            [['width','height','dpi','lpi','foil_stencil_varnish', 'set_form_count',
                'pantone_id','photo_output_id','combination_id',
                'polymer_id','envelope_id','form_defect_id_temp'],'safe'],
        ];
    }


    public function createForm($label){
        $i = $this->set_form_count;
        while ($i > 0) {
            $form=new Form();
            $form->pantone_id=$this->pantone_id;
            $form->width=$this->width;
            $form->height=$this->height;
            $form->lpi=$this->lpi;
            $form->dpi=$this->dpi;
            $form->photo_output_id=$this->photo_output_id;
            if(!empty($label->combinated_label))
                $form->combination_id=$label->combination->id;
            else
                $form->label_id=$label->id;
            $form->save();
            $i--;
        }
    }
}