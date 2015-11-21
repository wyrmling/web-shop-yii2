<?php

namespace app\models;

use yii\db\ActiveRecord;

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
            // email has to be a valid email address
//            ['email', 'email'],
            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels() {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'content' => 'Текст новости'
        ];
    }

}