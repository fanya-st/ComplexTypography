<?php
namespace app\rbac;

use yii\rbac\Rule;
use app\models\User;

class AllowToDesignReadyRule extends Rule
{
    public $name = 'AllowToDesignReadyRule';
    public function execute($user, $item, $params)
    {
        return isset($params['label']) ? ($params['label']->status_id == 2 and $params['label']->designer_login == User::findIdentity($user)->username) : false;
    }
}