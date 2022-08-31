<?php

namespace app\models;
use yii;
use yii\helpers\ArrayHelper;

class User extends yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'username'=>'Логин',
            'password'=>'Пароль',
            'F'=>'Фамилия',
            'I'=>'Имя',
            'O'=>'Отчество',
            'status_id'=>'Статус',
            'rememberMe'=>'Запомнить меня',
        ];
    }
    public function rules(){
        return[
            [['F','I','O','password'],'string','max'=>100],
            [['username'],'string','max'=>50],
            [['username','password','F','I','O'],'trim'],
            [['username','password','F','I','O'],'required'],
            [['status_id'],'integer'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->authKey=\Yii::$app->security->generateRandomString();
//                $this->accessToken=\Yii::$app->security->generateRandomString();
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
                Yii::$app->session->setFlash('success', 'Сотрудник добавлен!');
            } else {
                $this->authKey=\Yii::$app->security->generateRandomString();
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
                Yii::$app->session->setFlash('success', 'Запись обновлена!');
            }
            return true;
        } else {
            return false;
        }
    }

    public static function findIdentity($id)
    {
        return !empty(self::findOne($id)) ? new static(self::findOne($id)) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::find()->all() as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findUsersByGroup($group)
    {
        foreach(self::find()->all() as $user){
            if($user->status_id==0){
                if(ArrayHelper::keyExists($group, Yii::$app->authManager->getRolesByUser($user->id), false)
                    OR ArrayHelper::keyExists($group.'_admin', Yii::$app->authManager->getRolesByUser($user->id ),false))
                    $array[$user->username]=$user->F.' '.mb_substr($user->I,0,1).'.';
            }
        }
        return $array;
    }

    public static function findUsersDropdown()
    {
        foreach(self::find()->all() as $user){
            if($user->status_id==0){
                $array[$user->username]=$user->F.' '.mb_substr($user->I,0,1).'.';
            }
        }
        return $array;
    }

    public static function findUsersIdDropdown()
    {
        foreach(self::find()->all() as $user){
            if($user->status_id==0){
                $array[$user->id]=$user->F.' '.mb_substr($user->I,0,1).'.';
            }
        }
        return $array;
    }

    public static function getFullNameByUsername($username)
    {
        foreach(self::find()->all() as $user){
            if($user->username == $username)
            return $user->F.' '.mb_substr($user->I,0,1).'.';
        }
    }

    public static function getFullNameById($id)
    {
        foreach(self::find()->all() as $user){
            if($user->id == $id)
            return $user->F.' '.mb_substr($user->I,0,1).'.';
        }
    }

    public static function getUserList()
    {
        $user_list=[];
        foreach(self::find()->all() as $user){
            if($user->status_id==0){
                ArrayHelper::setValue($user_list,$user->id.'.id',$user->id);
                ArrayHelper::setValue($user_list,$user->id.'.username',$user->username);
                ArrayHelper::setValue($user_list,$user->id.'.F',$user->F);
                ArrayHelper::setValue($user_list,$user->id.'.I',$user->I);
                ArrayHelper::setValue($user_list,$user->id.'.O',$user->O);

                ArrayHelper::setValue($user_list,$user->id.'.start_time',$user->start_time);
                ArrayHelper::setValue($user_list,$user->id.'.end_time',$user->end_time);
                ArrayHelper::setValue($user_list,$user->id.'.group',Yii::$app->authManager->getAssignments($user->id));
            }
        }
        return $user_list;
    }

    public static function findByUsername($username)
    {
        foreach (self::find()->all() as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }


    public function beforeDelete()
    {
        if ($this->id==1) {
            Yii::$app->session->setFlash('error','Нельзя удалять Администратора!');
            return false;
        }
        return parent::beforeDelete();
    }

}
