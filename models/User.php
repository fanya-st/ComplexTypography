<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{

    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $group;
    public $F;
    public $I;
    public $O;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
            'group' => 'admin',
        ],
        '101' => [
            'id' => '101',
            'username' => 'Alex',
            'password' => 'Alex',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
            'group' => 'prepress',
            'F' => 'Агапов',
            'I' => 'Алексей',
            'O' => '',
        ],
		'102' => [
            'id' => '102',
            'username' => 'Jura',
            'password' => 'Jura',
            'authKey' => 'test102key',
            'accessToken' => '102-token',
            'group' => 'manager_admin',
            'F' => 'Фадеев',
            'I' => 'Юрий',
            'O' => 'Вячеславович',
        ],
        '103' => [
            'id' => '103',
            'username' => 'Hamida',
            'password' => 'Hamida',
            'authKey' => 'test103key',
            'accessToken' => '103-token',
            'group' => 'manager',
            'F' => 'Салахова',
            'I' => 'Хамида',
            'O' => 'Шавкатовна',
        ],
        '104' => [
            'id' => '104',
            'username' => 'Natasha',
            'password' => 'Natasha',
            'authKey' => 'test104key',
            'accessToken' => '104-token',
            'group' => 'designer_admin',
            'F' => 'Львова',
            'I' => 'Наталья',
            'O' => 'Петровна',
        ],
        '105' => [
            'id' => '105',
            'username' => 'Masha',
            'password' => 'Masha',
            'authKey' => 'test105key',
            'accessToken' => '105-token',
            'group' => 'designer',
            'F' => 'Кожевникова',
            'I' => 'Мария',
            'O' => '',
        ],
        '106' => [
            'id' => '106',
            'username' => 'Ivan',
            'password' => 'Ivan',
            'authKey' => 'test106key',
            'accessToken' => '106-token',
            'group' => 'laboratory',
            'F' => 'Карпунин',
            'I' => 'Иван',
            'O' => '',
        ],
        '107' => [
            'id' => '107',
            'username' => 'Svetlana',
            'password' => 'Svetlana',
            'authKey' => 'test107key',
            'accessToken' => '107-token',
            'group' => 'designer',
            'F' => 'Герасимова',
            'I' => 'Светлана',
            'O' => '',
        ],
        '108' => [
            'id' => '108',
            'username' => 'Maksim',
            'password' => 'Maksim',
            'authKey' => 'test108key',
            'accessToken' => '108-token',
            'group' => 'printer',
            'F' => 'Прокаев',
            'I' => 'Максим',
            'O' => '',
        ],
        '109' => [
            'id' => '109',
            'username' => 'Ilnur',
            'password' => 'Ilnur',
            'authKey' => 'test109key',
            'accessToken' => '109-token',
            'group' => 'rewinder',
            'F' => 'Мугинов',
            'I' => 'Ильнур',
            'O' => '',
        ],
        '110' => [
            'id' => '110',
            'username' => 'Albert',
            'password' => 'Albert',
            'authKey' => 'test110key',
            'accessToken' => '110-token',
            'group' => 'packer',
            'F' => 'Миннеханов',
            'I' => 'Альберт',
            'O' => '',
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }
//    public static function getFullName($username)
//        {
//            return self::$users[$id]) ? new static(self::$users[$id]) : null;
//        }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }
    public static function findUsersByGroup($group)
    {
        foreach(self::$users as $user){
            if($user['group']== $group OR $user['group']== $group.'_admin')
            $array[$user['username']]=$user['F'].' '.mb_substr($user['I'],0,1).'.';
        }
        return $array;
    }
    public static function getFullNameByUsername($username)
    {
        foreach(self::$users as $user){
            if($user['username']== $username)
            return $user['F'].' '.mb_substr($user['I'],0,1).'.';
        }
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
