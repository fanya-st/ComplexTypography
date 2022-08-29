<?php

namespace app\rbac;

use app\models\User;
use yii\rbac\Rule;

class ManagerRule extends Rule
{
    public $name = 'isManager';

    public function execute($user, $item, $params)
    {
        return isset($params['item']) ? $params['item']->manager_login == User::findIdentity($user)->username : false;
    }
}