<?php


namespace app\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class CustomNav extends Model
{
    public static function getItemByStatusDesigner($status,$id){
        $nav_items=['designer'=>
            ['label' => 'Дизайнер', 'items' => [
                ['label' => 'Внести изменения', 'url' => ['label/update','id'=>$id]]
            ]
            ]
        ];
        switch ($status) {
            case 1:
                ArrayHelper::setValue($nav_items, 'designer.items.', ['label' => 'Создать дизайн', 'url' => ['label/create-design','id'=>$id]]);
                break;
            case 2:
                ArrayHelper::setValue($nav_items, 'designer.items.', ['label' => 'Дизайн готов', 'url' => ['label/create-design-ready','id'=>$id]]);
                break;
            case 3:
                ArrayHelper::setValue($nav_items, 'designer.items.', ['label' => 'Изменить картинки и примечания', 'url' => ['label/create-design-ready','id'=>$id,'change_image'=>1]]);
                break;
        }
        return $nav_items;
    }
}