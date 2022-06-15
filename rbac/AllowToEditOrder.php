<?php

namespace app\rbac;

use app\models\User;
use yii\rbac\Rule;

class AllowToEditOrder extends Rule
{
    public $name = 'AllowToEditOrder';

    public function execute($user, $item, $params)
    {
        return isset($params['order']) ? $params['order']->customer
                ->manager_login == User::findIdentity($user)->username : false;
    }
}