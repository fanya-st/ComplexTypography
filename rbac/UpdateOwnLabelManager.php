<?php
namespace app\rbac;

use app\models\User;
use yii\rbac\Rule;

class UpdateOwnLabelManager extends Rule
{
    public $name = 'isOwnLabel';
    public function execute($user, $item, $params)
    {
        return isset($params['label']) ? ($params['label']->manager_login == User::findIdentity($user)->username) : false;
    }
}