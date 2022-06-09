<?php

namespace app\rbac;

use yii\rbac\Rule;

class AllowToFlexformReadyRule extends Rule
{
    public $name = 'AllowToFlexformReadyRule';

    public function execute($user, $item, $params)
    {
        return isset($params['label']) ? $params['label']->status_id == 9 : false;
    }
}