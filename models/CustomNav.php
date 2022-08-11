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
                ArrayHelper::setValue($nav_items, 'prepress.items.combinate-label', ['label' => 'В совмещение', 'url' => ['label/combinate-label','id'=>$id]]);
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
        if (ArrayHelper::isIn($order->status_id, ['1']))
            ArrayHelper::setValue($items, 'items.update', ['label' => 'Внести изменения', 'url' => ['order/update','id'=>$order->id]]);
        if (ArrayHelper::isIn($order->status_id, ['1']))
            ArrayHelper::setValue($items, 'items.combinate-order', ['label' => 'Совместная печать', 'url' => ['order/combinate-order','id'=>$order->id]]);
        return $items;
    }
    public static function getOrderItemsPrinter($order){
        ArrayHelper::setValue($items, 'label','Печатник');
        if (ArrayHelper::isIn($order->status_id, ['1']))
            ArrayHelper::setValue($items, 'items.start-print', ['label' => 'Начать печать', 'url' => ['order/start-print','id'=>$order->id]]);
        if (ArrayHelper::isIn($order->status_id, ['2','3']))
            ArrayHelper::setValue($items, 'items.finish-print', ['label' => 'Закончить печать', 'url' => ['order/finish-print','id'=>$order->id]]);
        if (ArrayHelper::isIn($order->status_id, ['3']))
            ArrayHelper::setValue($items, 'items.continue-print', ['label' => 'Продолжить печать', 'url' => ['order/continue-print','id'=>$order->id]]);
        if (ArrayHelper::isIn($order->status_id, ['2']))
            ArrayHelper::setValue($items, 'items.paper-consumption', ['label' => 'Расход материала', 'url' => ['material/paper-consumption','id'=>$order->id]]);
        if (ArrayHelper::isIn($order->status_id, ['2','3']))
            ArrayHelper::setValue($items, 'items.form-defect', ['label' => 'Брак форм', 'url' => ['order/form-defect','id'=>$order->id]]);
        if (ArrayHelper::isIn($order->status_id, ['1','2','3']) && $order->label->variable==1)
            ArrayHelper::setValue($items, 'items.start-print-variable', ['label' => 'Начать печать переменной информации', 'url' => ['order/start-print-variable','id'=>$order->id]]);
        if (ArrayHelper::isIn($order->status_id, ['2','3']) && $order->label->variable==1)
            ArrayHelper::setValue($items, 'items.finish-print-variable', ['label' => 'Закончить печать переменной информации', 'url' => ['order/finish-print-variable','id'=>$order->id]]);

        return $items;
    }
    public static function getOrderItemsRewinder($order){
        ArrayHelper::setValue($items, 'label','Нарезчик и Перемотчик');
        if (ArrayHelper::isIn($order->status_id, ['4']))
            ArrayHelper::setValue($items, 'items.start-rewind', ['label' => 'Начать нарезку/перемотку', 'url' => ['order/start-rewind','id'=>$order->id]]);
        if (ArrayHelper::isIn($order->status_id, ['5']))
            ArrayHelper::setValue($items, 'items.rewind', ['label' => 'Нарезка/перемотка', 'url' => ['order/rewind','id'=>$order->id]]);

        return $items;
    }
    public static function getOrderItemsPacker($order){
        ArrayHelper::setValue($items, 'label','Упаковщик');
        if (ArrayHelper::isIn($order->status_id, ['6']))
            ArrayHelper::setValue($items, 'items.start-pack', ['label' => 'Начать упаковку', 'url' => ['order/start-pack','id'=>$order->id]]);
        if (ArrayHelper::isIn($order->status_id, ['7']))
            ArrayHelper::setValue($items, 'items.pack', ['label' => 'Упаковка', 'url' => ['order/pack','id'=>$order->id]]);
        ArrayHelper::setValue($items, 'items.print-box-label', ['label' => 'Печать ярлыков', 'url' => ['order/print-label-package','id'=>$order->id]]);
        return $items;
    }
}