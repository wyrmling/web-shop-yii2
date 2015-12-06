<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Users;

class News extends ActiveRecord
{

    const VISIBLE = 'visible';
    const HIDDEN = 'hidden';

    public static function tableName() {
        return 'news';
    }

    public function rules() {
        return [
            // name, email, subject and body are required
            [['title'], 'required'],
            [['title', 'description', 'content'], 'string'],
            ['user_id', 'default', 'value' => \Yii::$app->user->identity->getId()],
            // email has to be a valid email address
//            ['email', 'email'],
            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels() {
        return [
            'title' => 'Заголовок',
            'user_id' => 'ID автора',
            'description' => 'Описание',
            'content' => 'Текст новости'
        ];
    }

//    public function beforeSave($insert) {
//        parent::beforeSave($insert);
////        $this->user_id = \Yii::$app->user->identity->getId();
////        xdebug_break();
//    }

    public function getUser() {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    public static function status_list() {
        return [
            self::HIDDEN => 'Скрытая',
            self::VISIBLE => 'Видимая',
        ];
    }
    public static function getStatuses() {
        return [self::HIDDEN,self::VISIBLE];
    }

    public function getStatusName() {
        return $this->news_status;
    }



}