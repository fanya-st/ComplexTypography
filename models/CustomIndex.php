<?php


namespace app\models;

use kartik\icons\Icon;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii;

class CustomIndex extends Model
{
    public $items;


    public static function getIndexItems(){
        if(!Yii::$app->user->isGuest)
        foreach(Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->getId()) as $role){
            ArrayHelper::setValue($items, $role->name, ['label' => $role->description, 'content'=>Yii::$app->view->render('@app/views/site/tab-'.$role->name)]);
            if($role->name=='printer')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('print', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='manager')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('user', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='manager_admin')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('user-crown', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='admin'){
                ArrayHelper::setValue($items, 'guest', ['label' => Icon::show('border-all', ['class'=>'fa-1x']).'Все функции', 'content'=>Yii::$app->view->render('@app/views/site/index')]);
            }
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('user-shield', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='packer')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('box-open', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='logistician')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('truck', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='rewinder')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('toilet-paper', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='prepress')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('swatchbook', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='designer_admin')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('user-crown', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='designer')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('layer-group', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='laboratory')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('clone', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='driver')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('steering-wheel', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='warehouse_manager')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('warehouse', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='technolog')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('wrench', ['class'=>'fa-1x']).$role->description);
            if ($role->name=='accountant')
                ArrayHelper::setValue($items, $role->name.'.label',Icon::show('wallet', ['class'=>'fa-1x']).$role->description);

        }
        else{
            ArrayHelper::setValue($items, 'guest', ['label' => Icon::show('', ['class'=>'fa-1x']).'Гость', 'content'=>Yii::$app->view->render('@app/views/site/tab-guest')]);
        }
//        switch ($status) {
//            //статус этикетки новая этикетка
//            case 1:
//                ArrayHelper::setValue($nav_items, 'manager.items.approve-design', ['label' => 'Внести изменения', 'url' => ['label/update','id'=>$id]]);
//                break;
//            //статус этикетки дизайн готов
//            case 3:
//                ArrayHelper::setValue($nav_items, 'manager.items.approve-design', ['label' => 'Утвердить дизайн', 'url' => ['label/approve-design','id'=>$id]]);
//                break;
//        }
        return $items;
    }
}