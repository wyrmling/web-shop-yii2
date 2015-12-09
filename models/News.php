<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Users;
use yii\behaviors\TimestampBehavior;

class News extends ActiveRecord
{

    const HIDDEN = 0;
    const VISIBLE = 1;

    public static function tableName() {
        return 'news';
    }

    public function rules() {
        return [
            [['title'], 'required'],
            [['title', 'description', 'content'], 'string'],
            ['news_status', 'boolean'],
            ['user_id', 'default', 'value' => \Yii::$app->user->identity->getId()],
//            ['news_status', 'default', 'value' => self::VISIBLE, 'isEmpty' => true, 'when' => function($model) {return $model->isNewRecord;}],
                // email has to be a valid email address
//            ['email', 'email'],
            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels() {
        return [
            'news_id' => 'ID новости',
            'title' => 'Заголовок',
            'user_id' => 'ID автора',
            'description' => 'Описание',
            'content' => 'Текст новости',
            'time_created' => 'Время создания',
            'time_updated' => 'Время обновления',
            'news_status' => 'Статус новости',
        ];
    }

    public function getUser() {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

//    public function behaviors() {
//        return [
//            TimestampBehavior::className(),
//        ];
//    }

    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'time_created',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'time_updated',
                ],
//                'value' => new \yii\db\Expression('NOW()')
                'value' => function() {
                    return \Yii::$app->formatter->asDate('now', 'php:Y-m-d h:i:s');
                }
            ]
        ];
    }

    public static function status_list() {
        return [
            self::HIDDEN => ['Скрытая', 'hidden'],
            self::VISIBLE => ['Видимая', 'visible'],
        ];
    }
    public static function getStatuses() {
        return [self::HIDDEN,self::VISIBLE];
    }

    public static function getStatus($status, $tag = false) {
        if ($tag) {
            return self::status_list()[$status][1];
        } else {
            return self::status_list()[$status][0];
        }
//        return [self::HIDDEN,self::VISIBLE];
    }

//    public function getStatusName() {
//        return $this->news_status;
//    }



}