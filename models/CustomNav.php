<?php


namespace app\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class CustomNav extends Model
{
//    public static function getItemByGroupStatusId($group,$status,$id){
//        switch ($group) {
//            case 'designer':
//            case 'designer_admin':
//                $nav_items_d=CustomNav::getItemByStatusDesigner($label->status_id,$label->id);
//                break;
//            case 'manager':
//            case 'manager_admin':
//                $nav_items_m=CustomNav::getItemByStatusManager($label->status_id,$label->id);
//                break;
//            case 'prepress':
//                $nav_items_pr=CustomNav::getItemByStatusPrepress($label->status_id,$label->id);
//                break;
//        }
//    }
    public static function getItemByStatusDesigner($status,$id){
        $nav_items=['designer'=>
            ['label' => 'Дизайнер', 'items' => [
                ['label' => 'Внести изменения', 'url' => ['label/update','id'=>$id]]
            ]
            ]
        ];
        switch ($status) {
            //статус этикетки новая этикетка
            case 1:
                ArrayHelper::setValue($nav_items, 'designer.items.', ['label' => 'Создать дизайн', 'url' => ['label/create-design','id'=>$id]]);
                break;
            //статус этикетки в дизайне
            case 2:
                ArrayHelper::setValue($nav_items, 'designer.items.', ['label' => 'Дизайн готов', 'url' => ['label/design-ready','id'=>$id]]);
                break;
            //статус этикетки дизайн готов
            case 3:
                ArrayHelper::setValue($nav_items, 'designer.items.', ['label' => 'Изменить картинки и примечания', 'url' => ['label/create-design-ready','id'=>$id,'change_image'=>1]]);
                break;
        }
        return $nav_items;
    }
    public static function getItemByStatusManager($status,$id){
        $nav_items=['manager'=>
            ['label' => 'Менеджер', 'items' => [
                ['label' => 'Внести изменения', 'url' => ['label/update','id'=>$id]],
                ['label' => 'Создать подобную', 'url' => ['label/create']],
                ['label' => 'Заказ в печать', 'url' => ['order/create','label_id'=>$id,'blank'=>0]]
            ]
            ]
        ];
        switch ($status) {
            //статус этикетки новая этикетка
            case 1:
                break;
            //статус этикетки в дизайне
            case 2:
                break;
            //статус этикетки дизайн готов
            case 3:
                ArrayHelper::setValue($nav_items, 'manager.items.', ['label' => 'Утвердить дизайн', 'url' => ['label/approve-design','id'=>$id]]);
                break;
        }
        return $nav_items;
    }
    public static function getItemByStatusPrepress($status,$id){
        $nav_items=['prepress'=>
            ['label' => 'Prepress', 'items' => [
            ]
            ]
        ];
        switch ($status) {
            //статус этикетки дизайн готов дизайн утвержден и ожидает перевывода
            case 4:
            case 5:
                ArrayHelper::setValue($nav_items, 'prepress.items.', ['label' => 'В Prepress', 'url' => ['label/create-prepress','id'=>$id]]);
                break;
            case 6:
                ArrayHelper::setValue($nav_items, 'prepress.items.', ['label' => 'Prepress готов', 'url' => ['label/prepress-ready','id'=>$id]]);
                break;
        }
        return $nav_items;
    }
    public static function getItemByStatusLaboratory($status,$id){
        $nav_items=['laboratory'=>
            ['label' => 'Лаборатория', 'items' => [
            ]
            ]
        ];
        switch ($status) {
            //статус этикетки Prepress готов
            case 7:
            case 8:
                ArrayHelper::setValue($nav_items, 'laboratory.items.', ['label' => 'Изготовление форм', 'url' => ['label/create-flexform','id'=>$id]]);
                break;
            //статус этикетки Изготовление форм
            case 9:
                ArrayHelper::setValue($nav_items, 'laboratory.items.', ['label' => 'Формы готовы', 'url' => ['label/flexform-ready','id'=>$id]]);
                break;

        }
        return $nav_items;
    }
}