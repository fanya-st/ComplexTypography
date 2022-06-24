<?php

namespace app\rbac;

use app\models\User;
use yii\rbac\Rule;

class AllowToEditCustomer extends Rule
{
    public $name = 'AllowToEditCustomer';

    public function execute($user, $item, $params)
    {
        return isset($params['customer']) ? $params['customer']->manager_login == User::findIdentity($user)->username : false;
    }
}