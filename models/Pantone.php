<?php


namespace app\models;
use yii;
use yii\helpers\ArrayHelper;


use yii\db\ActiveRecord;

class Pantone extends ActiveRecord
{
    public function getPantoneKind(){
        return $this->hasOne(PantoneKind::class,['id'=>'pantone_kind_id']);
    }

    public function getMixedPantone(){
        return $this->hasMany(MixedPantone::class,['pantone_id'=>'id']);
    }

    public function getMashinePantone(){
        return $this->hasMany(MashinePantone::class,['pantone_id'=>'id']);
    }

    public function getMashine(){
        return $this->hasMany(Mashine::class,['id'=>'mashine_id'])->via('mashinePantone');
    }

    public $mashine_list;


    public function rules()
    {
        return [
            [['name','mashine_list'], 'required'],
            [['id','pantone_kind_id'], 'integer'],
            [['price_rub','price_euro','price_rub_discount','price_euro_discount',], 'double'],
            [['name'], 'string','max'=>50],
            [['subscribe'], 'string','max'=>100],
            [['name','subscribe'], 'trim'],
            [['mashine_list'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pantone_kind_id' => 'Тип PANTONE',
            'name' => 'Наименование',
            'price_rub' => 'Цена, руб/кг',
            'price_rub_discount' => 'Цена со скидкой, руб/кг',
            'price_euro' => 'Цена, евро/кг',
            'price_euro_discount' => 'Цена со скидкой, евро/кг',
            'subscribe' => 'Подсказка',
            'mashine_list' => 'Совместимость со станками',
        ];
    }

    public function afterSave($insert, $changedAttributes) {
        if ($insert) {
            if($this->pantone_kind_id==2){
                $count=8;
                while($count>0){
                    $mixed_pantone=new MixedPantone();
                    $mixed_pantone->pantone_id=$this->id;
                    $mixed_pantone->save();
                    $count--;
                }
            }
            Yii::$app->session->setFlash('success', 'PANTONE добавлен');
        } else {
            Yii::$app->session->setFlash('success', 'PANTONE обновлен');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterFind()
    {
        $this->mashine_list = MashinePantone::find()->select('mashine_id')->where(['pantone_id'=>$this->id])->asArray()->column();
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
            } else {
                if ($this->getOldAttribute('price_rub')!=$this->price_rub) {
                    $archive=new PantonePriceArchive();
                    $archive->pantone_id=$this->id;
                    $archive->price_attribute='price_rub';
                    $archive->old_value=$this->getOldAttribute('price_rub');
                    $archive->save();
                }
                if ($this->getOldAttribute('price_rub_discount')!=$this->price_rub_discount) {
                    $archive=new PantonePriceArchive();
                    $archive->pantone_id=$this->id;
                    $archive->price_attribute='price_rub_discount';
                    $archive->old_value=$this->getOldAttribute('price_rub_discount');
                    $archive->save();
                }
                if ($this->getOldAttribute('price_euro_discount')!=$this->price_euro_discount) {
                    $archive=new PantonePriceArchive();
                    $archive->pantone_id=$this->id;
                    $archive->price_attribute='price_euro_discount';
                    $archive->old_value=$this->getOldAttribute('price_euro_discount');
                    $archive->save();
                }
                if ($this->getOldAttribute('price_euro')!=$this->price_euro) {
                    $archive=new PantonePriceArchive();
                    $archive->pantone_id=$this->id;
                    $archive->price_attribute='price_euro';
                    $archive->old_value=$this->getOldAttribute('price_euro');
                    $archive->save();
                }
            }
            if(!empty($this->mashine_list)){
                MashinePantone::deleteAll(['pantone_id'=>$this->id]);
                foreach ($this->mashine_list as $mashine_id){
                    $mashine_pantone=new MashinePantone();
                    $mashine_pantone->pantone_id=$this->id;
                    $mashine_pantone->mashine_id=$mashine_id;
                    $mashine_pantone->save();
                }
                unset($this->mashine_list);
            }
            return true;
        } else {
            return false;
        }
    }
}