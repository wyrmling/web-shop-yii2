<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Users extends ActiveRecord implements IdentityInterface
{

    const DISABLED = 0;
    const ACTIVE = 1;

    public static function tableName() {
        return 'users';
    }

    public function attributeLabels() {
        return [
            'user_id' => 'ID автора',
            'username' => 'Имя пользователя',
            'group' => 'Имя пользователя',
//            'content' => 'Текст новости',
//            'news_status' => 'Статус новости',
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $user_id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($user_id)
    {
        return static::findOne($user_id);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
//        return static::findOne(['access_token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
//        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
//        return $this->auth_key === $authKey;
    }

}