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
            foreach(Yii::$app->authManager->getChildRoles($role->name) as $childRole){
                if(file_exists(Yii::getAlias('@app').'/views/site/tab-'.$childRole->name.'.php')){
                    ArrayHelper::setValue($items, $childRole->name, ['label' => $childRole->description, 'content'=>Yii::$app->view->render('@app/views/site/tab-'.$childRole->name)]);

                    //добавление иконки
                    switch($childRole->name){
                        case 'printer': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('print', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'manager': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('user', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'admin': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('user-shield', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'packer': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('box-open', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'logistician': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('truck', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'rewinder': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('toilet-paper', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'prepress': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('swatchbook', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'designer': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('layer-group', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'laboratory': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('clone', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'driver': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('steering-wheel', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'warehouse_manager': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('warehouse', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'technolog': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('wrench', ['class'=>'fa-1x']).$childRole->description);
                        break;
                        case 'accountant': ArrayHelper::setValue($items, $childRole->name.'.label',Icon::show('wallet', ['class'=>'fa-1x']).$childRole->description);
                        break;
                    }
                }
            }

        }
        else{
            ArrayHelper::setValue($items, 'guest', ['label' => Icon::show('', ['class'=>'fa-1x']).'Гость', 'content'=>Yii::$app->view->render('@app/views/site/tab-guest')]);
        }
        return $items;
    }
}