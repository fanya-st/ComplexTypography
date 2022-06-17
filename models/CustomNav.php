<?php


namespace app\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class CustomNav extends Model
{
    public static function getItemByStatusDesigner($status,$id){
        $nav_items=['designer'=>
            ['label' => 'Дизайнер', 'items' => []
            ]
        ];
        switch ($status) {
            //статус этикетки новая этикетка
            case 1:
                ArrayHelper::setValue($nav_items, 'designer.items.create-design', ['label' => 'Создать дизайн', 'url' => ['label/create-design','id'=>$id]]);
                break;
            //статус этикетки в дизайне
            //статус этикетки дизайн готов
            case 2:
            case 3:
                ArrayHelper::setValue($nav_items, 'designer.items.design-ready',
                    ['label' => 'Дизайн готов', 'url' => ['label/design-ready','id'=>$id]]);
                break;
        }
        return $nav_items;
    }
    public static function getItemByStatusManager($status,$id){
        $nav_items=['manager'=>
            ['label' => 'Менеджер', 'items' => [
                ['label' => 'Создать подобную', 'url' => ['label/create-same','id'=>$id]],
                ['label' => 'Заказ в печать', 'url' => ['order/create','label_id'=>$id,'blank'=>0]]
            ]
            ]
        ];
        switch ($status) {
            //статус этикетки новая этикетка
            case 1:
                ArrayHelper::setValue($nav_items, 'manager.items.approve-design', ['label' => 'Внести изменения', 'url' => ['label/update','id'=>$id]]);
                break;
            //статус этикетки дизайн готов
            case 3:
                ArrayHelper::setValue($nav_items, 'manager.items.approve-design', ['label' => 'Утвердить дизайн', 'url' => ['label/approve-design','id'=>$id]]);
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
                ArrayHelper::setValue($nav_items, 'prepress.items.create-prepress', ['label' => 'В Prepress', 'url' => ['label/create-prepress','id'=>$id]]);
                break;
            case 5:
                ArrayHelper::setValue($nav_items, 'prepress.items.re-prepress', ['label' => 'Перевывод готов', 'url' => ['label/re-prepress','id'=>$id]]);
                break;
            case 6:
                ArrayHelper::setValue($nav_items, 'prepress.items.prepress-ready', ['label' => 'Prepress готов', 'url' => ['label/prepress-ready','id'=>$id]]);
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
                ArrayHelper::setValue($nav_items, 'laboratory.items.create-flexform', ['label' => 'Изготовление форм', 'url' => ['label/create-flexform','id'=>$id]]);
                break;
            case 8:
                ArrayHelper::setValue($nav_items, 'laboratory.items.create-flexform', ['label' => 'Изготовление форм (перевывод)', 'url' => ['label/create-flexform','id'=>$id]]);
                break;
            //статус этикетки Изготовление форм
            case 9:
                ArrayHelper::setValue($nav_items, 'laboratory.items.flexform-ready', ['label' => 'Формы готовы', 'url' => ['label/flexform-ready','id'=>$id]]);
                ArrayHelper::setValue($nav_items, 'laboratory.items.re-flexform-ready', ['label' => 'Формы готовы (перевывод)', 'url' => ['label/re-flexform-ready','id'=>$id]]);
                break;

        }
        return $nav_items;
    }

    public static function getOrderItemsManager($order){
        ArrayHelper::setValue($items, 'label','Менеджер');
        ArrayHelper::setValue($items, 'items.update',
            ['label' => 'Внести изменения', 'url' => ['order/update','id'=>$order->id]]);
        ArrayHelper::setValue($items, 'items.combinate-order',
            ['label' => 'Совместная печать', 'url' => ['order/combinate-order','id'=>$order->id]]);
        return $items;
    }
    public static function getOrderItemsPrinter($order){
        ArrayHelper::setValue($items, 'label','Печатник');
        switch ($order->status_id) {
            //статус заказа Новый
            case 1:
                ArrayHelper::setValue($items, 'items.start-print', ['label' => 'Начать печать', 'url' => ['order/start-print','id'=>$order->id]]);
                break;
            case 2:
                ArrayHelper::setValue($items, 'items.pause-print', ['label' => 'Приостановить печать', 'url' => ['order/pause-print','id'=>$order->id]]);
                ArrayHelper::setValue($items, 'items.finish-print', ['label' => 'Закончить печать', 'url' => ['order/finish-print','id'=>$order->id]]);
                ArrayHelper::setValue($items, 'items.paper-consumption', ['label' => 'Расход материала', 'url' => ['material/paper-consumption','id'=>$order->id]]);
                break;
            case 3:
                ArrayHelper::setValue($items, 'items.continue-print', ['label' => 'Продолжить печать', 'url' => ['order/continue-print','id'=>$order->id]]);
                ArrayHelper::setValue($items, 'items.finish-print', ['label' => 'Закончить печать', 'url' => ['order/finish-print','id'=>$order->id]]);
                break;
            case 4:
                break;
            case 5:
                break;
        }
        return $items;
    }
}