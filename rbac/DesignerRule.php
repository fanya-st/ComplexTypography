<?php
namespace app\rbac;

use app\models\User;
use yii\rbac\Rule;

class DesignerRule extends Rule
{
    public $name = 'isDesigner';
    public function execute($user, $item, $params)
    {
        return isset($params['item']) ? ($params['item']->designer_id == User::findIdentity($user)->getId()) : false;
    }
}