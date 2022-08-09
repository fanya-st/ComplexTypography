<?php

namespace app\models;
use yii;
use yii\helpers\ArrayHelper;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{

    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $F;
    public $I;
    public $O;
    public $start_time;
    public $end_time;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
            'F' => 'Администратор',
            'I' => 'Администратор',
            'O' => '',
        ],
        '101' => [
            'id' => '101',
            'username' => 'Alex',
            'password' => 'Alex',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
            'F' => 'Агапов',
            'I' => 'Алексей',
            'O' => '',
            'start_time' => '8:00',
            'end_time' => '17:00',
        ],
		'102' => [
            'id' => '102',
            'username' => 'Jura',
            'password' => 'Jura',
            'authKey' => 'test102key',
            'accessToken' => '102-token',
            'F' => 'Фадеев',
            'I' => 'Юрий',
            'O' => 'Вячеславович',
            'start_time' => '8:00',
            'end_time' => '17:00',
        ],
        '103' => [
            'id' => '103',
            'username' => 'Hamida',
            'password' => 'Hamida',
            'authKey' => 'test103key',
            'accessToken' => '103-token',
            'F' => 'Салахова',
            'I' => 'Хамида',
            'O' => 'Шавкатовна',
            'start_time' => '8:00',
            'end_time' => '17:00',
        ],
        '104' => [
            'id' => '104',
            'username' => 'Natasha',
            'password' => 'Natasha',
            'authKey' => 'test104key',
            'accessToken' => '104-token',
            'F' => 'Львова',
            'I' => 'Наталья',
            'O' => 'Петровна',
            'start_time' => '8:00',
            'end_time' => '17:00',
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
            'start_time' => '8:00',
            'end_time' => '17:00',
        ],
        '106' => [
            'id' => '106',
            'username' => 'Ivan',
            'password' => 'Ivan',
            'authKey' => 'test106key',
            'accessToken' => '106-token',
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
            'F' => 'Герасимова',
            'I' => 'Светлана',
            'O' => '',
            'start_time' => '8:00',
            'end_time' => '17:00',
        ],
        '108' => [
            'id' => '108',
            'username' => 'Maksim',
            'password' => 'Maksim',
            'authKey' => 'test108key',
            'accessToken' => '108-token',
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
            'F' => 'Миннегалиев',
            'I' => 'Альберт',
            'O' => '',
            'start_time' => '8:00',
            'end_time' => '17:00',
        ],
        '111' => [
            'id' => '111',
            'username' => 'Rustam',
            'password' => 'Rustam',
            'authKey' => 'test111key',
            'accessToken' => '111-token',
            'F' => 'Сабирзянов',
            'I' => 'Рустам',
            'O' => '',
            'start_time' => '8:00',
            'end_time' => '19:00',
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

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

    public static function findWorkingTimeByUserName($username)
    {
        foreach(self::$users as $user){
            if($user['username']== $username){
                $start=date_create($user['start_time']);
                $end=date_create($user['end_time']);
                return date_diff($start,$end)->h;
            }
        }

        return null;
    }
    public static function findUsersByGroup($group)
    {
        foreach(self::$users as $user){
            if(ArrayHelper::keyExists($group, Yii::$app->authManager->getRolesByUser($user['id']), false)
            OR ArrayHelper::keyExists($group.'_admin', Yii::$app->authManager->getRolesByUser($user['id']), false))
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

    public static function getUserList()
    {
        $user_list=[];
        foreach(self::$users as $user){
            ArrayHelper::setValue($user_list,$user['id'].'.id',$user['id']);
            ArrayHelper::setValue($user_list,$user['id'].'.username',$user['username']);
            ArrayHelper::setValue($user_list,$user['id'].'.F',$user['F']);
            ArrayHelper::setValue($user_list,$user['id'].'.I',$user['I']);
            ArrayHelper::setValue($user_list,$user['id'].'.O',$user['O']);

            ArrayHelper::setValue($user_list,$user['id'].'.start_time',$user['start_time']);
            ArrayHelper::setValue($user_list,$user['id'].'.end_time',$user['end_time']);
            ArrayHelper::setValue($user_list,$user['id'].'.group',Yii::$app->authManager->getAssignments($user['id']));
        }
        return $user_list;
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
