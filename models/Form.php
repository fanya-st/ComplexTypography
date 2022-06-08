<?php


namespace app\models;


use yii\db\ActiveRecord;

class Form extends ActiveRecord
{
    public function getPhotoOutput(){
        return $this->hasOne(PhotoOutput::class,['id'=>'photo_output_id']);
    }
    public function getPantone(){
        return $this->hasOne(Pantone::class,['id'=>'pantone_id']);
    }

    public function getPantoneName(){
        if (isset($this->pantone))
            return $this->pantone->name;
            elseif($this->stencil_form==1) return 'Трафаретная форма';
            elseif($this->varnish_form==1) return 'Лаковая форма';
            elseif($this->foil_form==1) return 'Форма фольги';
    }

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'polymer_id'=>'Полимер',
            'width'=>'Ширина, мм',
            'height'=>'Высота, мм',
            'lpi'=>'Линиатура',
            'dpi'=>'Разрешение',
            'photoOutput.name'=>'Фотовывод',
            'pantoneName'=>'Пантон',
            'stencil_form'=>'Трафарет',
            'foil_form'=>'Фольга',
            'varnish_form'=>'Лаковая форма',
        ];
    }

    public static function createVarnishForm($prepress,$label_id,$set_count){
        $i=$set_count;
        while ($i>0){
            $form= $prepress;
            unset($form->id);
            unset($form->pantone_id);
            unset($form->foil_form);
            unset($form->stencil_form);
            $form->setisNewRecord(true);
            if($prepress->combination_id==Null)$form->label_id= $label_id;
            $form->varnish_form= 1;
            $form->save();
            $i--;
        }
    }
    public static function createPantoneForm($prepress,$label_id,$set_count,$pantone_list){
        foreach ($pantone_list as $pantone){
            $i=$set_count;
            while ($i>0){
                $form=$prepress;
                unset($form->id);
                $form->setisNewRecord(true);
                if($prepress->combination_id==Null)$form->label_id= $label_id;
                $form->pantone_id= $pantone;
                $form->save();
                $i--;
            }
        }
    }
    public static function createFoilForm($prepress,$label_id,$set_count){
        $i=$set_count;
        while ($i>0){
            $form= $prepress;
            unset($form->id);
            unset($form->pantone_id);
            unset($form->varnish_form);
            unset($form->stencil_form);
            $form->setisNewRecord(true);
            if($prepress->combination_id==Null)$form->label_id= $label_id;
            $form->foil_form= 1;
            $form->save();
            $i--;
        }
    }
    public static function createStencilForm($prepress,$label_id,$set_count){
        $i=$set_count;
        while ($i>0){
            $form= $prepress;
            unset($form->id);
            unset($form->pantone_id);
            unset($form->foil_form);
            unset($form->varnish_form);
            $form->setisNewRecord(true);
            if($prepress->combination_id==Null)$form->label_id= $label_id;
            $form->stencil_form= 1;
            $form->save();
            $i--;
        }
    }
}