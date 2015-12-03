<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Users;

class News extends ActiveRecord
{

    public static function tableName() {
        return 'news';
    }

    public function rules() {
        return [
            // name, email, subject and body are required
            [['title'], 'required'],
            [['description', 'content'], 'string'],
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

}