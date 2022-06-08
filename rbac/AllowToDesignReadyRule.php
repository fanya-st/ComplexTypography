<?php
namespace app\rbac;

use yii\rbac\Rule;

class AllowToDesignReadyRule extends Rule
{
    public $name = 'AllowToDesignReadyRule';
    public function execute($user, $item, $params)
    {
        return isset($params['label']) ? $params['label']->status_id == 2 : false;
    }
}