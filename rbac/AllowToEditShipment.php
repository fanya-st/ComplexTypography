<?php

namespace app\rbac;

use app\models\User;
use yii\rbac\Rule;

class AllowToEditShipment extends Rule
{
    public $name = 'AllowToEditShipment';

    public function execute($user, $item, $params)
    {
        return isset($params['shipment']) ? ($params['shipment']->manager_login == User::findIdentity($user)->username
            and $params['shipment']->status_id==0 ) : false;
    }
}