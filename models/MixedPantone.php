<?php

namespace app\models;

use Yii;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;


class MixedPantone extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return 'mixed_pantone';
    }

    public function getPantone(){
        return $this->hasOne(Pantone::class,['id'=>'component_pantone_id']);
    }

    public function rules()
    {
        return [
            [['pantone_id'], 'required'],
            [['pantone_id', 'component_pantone_id'], 'integer'],
            [['weight'], 'double'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pantone_id' => 'PANTONE',
            'component_pantone_id' => 'Компонент',
            'weight' => 'Вес',
        ];
    }

    public static function getFormAttribs() {
        return [
            'id'=>[
                'type'=>TabularForm::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'component_pantone_id'=>[
                'type'=>TabularForm::INPUT_DROPDOWN_LIST,
                'items'=>ArrayHelper::map(Pantone::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'columnOptions'=>['hAlign'=>GridView::ALIGN_CENTER,]
            ],
            'weight'=>[
                'type'=>TabularForm::INPUT_TEXT,
                'options'=>['class'=>'form-control text-right text-end'],
                'columnOptions'=>['hAlign'=>GridView::ALIGN_CENTER, 'width'=>'90px']
            ],
        ];
    }
}
