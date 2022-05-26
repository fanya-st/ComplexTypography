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
