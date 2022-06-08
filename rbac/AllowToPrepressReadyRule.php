<?php
namespace app\rbac;

use yii\rbac\Rule;

class AllowToPrepressReadyRule extends Rule
{
    public $name = 'AllowToPrepressReadyRule';
    public function execute($user, $item, $params)
    {
        return isset($params['label']) ? $params['label']->status_id == 6 : false;
    }
}