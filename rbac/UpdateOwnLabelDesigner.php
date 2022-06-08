<?php
namespace app\rbac;

use app\models\User;
use yii\rbac\Rule;

class UpdateOwnLabelDesigner extends Rule
{
    public $name = 'isOwnLabel';
    public function execute($user, $item, $params)
    {
        return isset($params['label']) ? ($params['label']->designer_login == User::findIdentity($user)->username) : false;
    }
}