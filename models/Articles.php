<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Users;
use yii\behaviors\TimestampBehavior;

class Articles extends ActiveRecord
    {

    const VISIBLE = 1;
    const HIDDEN = 0;
    const YES = 1;
    const NO = 0;

    public static function tableName()
    {
        return 'articles';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'description', 'content'], 'string'],
            [['article_status', 'comments_status'], 'boolean'],
            ['user_id', 'default', 'value' => \Yii::$app->user->identity->getId()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'article_id' => 'ID статьи',
            'title' => 'Заголовок',
            'user_id' => 'ID автора',
            'description' => 'Описание',
            'user.username' => 'Имя автора',
            'content' => 'Текст cтатьи',
            'time_created' => 'Cоздана',
            'time_updated' => 'Изменена',
            'article_status' => 'Статья доступна',
            'comments_status' => 'Комментарии разрешены',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    public function behaviors()
    {
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

    public static function status_list()
    {
        return [
            self::HIDDEN => ['Нет', 'hidden'],
            self::VISIBLE => ['Да', 'visible'],
        ];
    }

    public static function getStatuses()
    {
        return [self::HIDDEN,self::VISIBLE];
    }

    public static function getStatus($status, $tag = false)
    {
        if ($tag) {
            return self::status_list()[$status][1];
        } else {
            return self::status_list()[$status][0];
        }
    }

    }
