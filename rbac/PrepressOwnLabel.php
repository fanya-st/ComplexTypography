<?php
namespace app\rbac;

use app\models\User;
use yii\rbac\Rule;

class PrepressOwnLabel extends Rule
{
    public $name = 'isPrepressLabel';
    public function execute($user, $item, $params)
    {
        return isset($params['label']) ? $params['label']->prepress_login == User::findIdentity($user)->username : false;
    }
}